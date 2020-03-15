const WebSocket = require('ws');
const request = require('request');
const chalk = require('chalk');
const Server = require('ws').Server;
const Uuid = require('node-uuid');
const mysql = require('mysql');
const dbConfig = require('./dbConfig.json');

// 每次插入数据库的数据数量
const INSERT_NUMBER = 30;
// 表名
const BARRAGE_TABLE_NAME = 'barrage20200217';
const BANS_TABLE_NAME = 'ban20200217';

const connection = mysql.createConnection(dbConfig);
connection.connect();

let unsavedBarrages = [];
let unsavedBans = [];

const IP = '129.204.113.40';
const PORT = 8888;
const serviceWs = new Server({
    port: PORT
});

console.log(`service websocket running in ws://${IP}:${PORT}`);

// 存储所有的连接
let sockets = [];

serviceWs.on('connection', (socket) => {
    let id = Uuid.v1();
    sockets.push({
        id: id,
        socket: socket
    });
});

const ROOM_ID = 2550505;
const USERNAME = 245644962;
const UID = 245644962;

const ROOM_GIFT_URL = 'https://gift.douyucdn.cn/api/gift/v2/web/list';
const GIFT_URL = 'https://webconf.douyucdn.cn/resource/common/gift/gift_template';
// 单个礼物查询
const SINGLE_GIFT_URL = 'https://gift.douyucdn.cn/api/prop/v1/web/single';

const ws = new WebSocket('wss://danmuproxy.douyu.com:8505/', {
    origin: 'https://www.douyu.com'
});

// 房间礼物
let roomGift = {};
// 单独查询的礼物
let singleGift = {};

// 使用 socket 发送对象
function socketSendObject(socket, obj) {
    socket.send(JSON.stringify(obj));
}

// 广播消息
function broadcast(sockets, msg) {
    sockets.forEach(item => {
        socketSendObject(item.socket, msg);
    });
}

// 获取房间礼物列表和礼物的 json id
function getGiftInfo() {
    request(`${ROOM_GIFT_URL}?rid=${ROOM_ID}`, (err, res, body) => {
        if (err) {
            console.log(err);
        }
        else {
            let json = JSON.parse(body);
            for (let item of json.data.giftList) {
                roomGift[item.id] = item;
            }
            let tid = json.data.tid.split('_')[0];
            request(`${GIFT_URL}/${tid}.json`, (err, res, body) => {
                if (err) {
                    console.log(err);
                }
                else {
                    let giftJson = eval(body);
                    // console.log(giftJson.data);
                }
            });
        }
    });
}

// 回调
function DYConfigCallback(str) {
    return str;
}

getGiftInfo();

// 时间戳转时间
function formatNumber(n) {
    n = n.toString()
    return n[1] ? n : '0' + n
}
function formatTime(timestamp) {
    let date = new Date(timestamp * 1000)
    let year = date.getFullYear()
    let month = date.getMonth() + 1
    let day = date.getDate()
    let hour = date.getHours()
    let minute = date.getMinutes()
    let second = date.getSeconds()
    return [year, month, day].map(formatNumber).join('-') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

function dateFormat(fmt, date) {
    let ret;
    let opt = {
        "Y+": date.getFullYear().toString(), // 年
        "m+": (date.getMonth() + 1).toString(), // 月
        "d+": date.getDate().toString(), // 日
        "H+": date.getHours().toString(), // 时
        "M+": date.getMinutes().toString(), // 分
        "S+": date.getSeconds().toString() // 秒
        // 有其他格式化字符需求可以继续添加，必须转化成字符串
    };
    for (let k in opt) {
        ret = new RegExp("(" + k + ")").exec(fmt);
        if (ret) {
            fmt = fmt.replace(ret[1], (ret[1].length == 1) ? (opt[k]) : (opt[k].padStart(ret[1].length, "0")))
        };
    };
    return fmt;
}

// 编辑发送包
function encode(msg) {
    let data = Buffer.alloc(msg.length + 13);
    data.writeInt32LE(msg.length + 9, 0);
    data.writeInt32LE(msg.length + 9, 4);
    data.writeInt32LE(689, 8);
    data.write(msg + '\0', 12);
    return data;
}

// 小端整数转十进制进制
function littleIntToInt(byteStr) {
    let s = '';
    for (let str of byteStr) {
        s += completeHex(str.toString(16));
    }
    return parseInt(s, 16);
}

// 补 0
function completeHex(bit) {
    if (bit.length == 1) {
        return '0' + bit;
    }
    else if(bit.length == 2){
        return bit;
    }
}

// 解析收到的字节包
function decode(bytes) {
    /**
     * 一个数据包可能有多条信息
     * 前 4 个字节为当前条数据的长度
     * 前 24 字节为长度和头部, 过滤掉, 剩下的为数据部分
     * 每条数据会多占 4 个字节, 暂时不知道用处
     */

    // 消息总长度
    let totalLength = bytes.length;
    // 当前消息长度
    let len = 0;
    // 已解析的消息长度
    let decodedMsgLen = 0;
    // 单条消息的 buffer
    let singleMsgBuffer = null;
    // 取长度的 16 进制
    let lenStr;
    while (decodedMsgLen < totalLength) {
        lenStr = bytes.slice(decodedMsgLen, decodedMsgLen + 4);
        len = littleIntToInt(lenStr.reverse()) + 4;
        singleMsgBuffer = bytes.slice(decodedMsgLen, decodedMsgLen + len);
        decodedMsgLen += len;
        // 去除头部和尾部的 '\0'
        let byteDatas = singleMsgBuffer.slice(12, singleMsgBuffer.length - 2).toString().split('/');
        // 解析后的消息对象
        let decodedMsg = {};
        for (let item of byteDatas) {
            let arr = item.split('@=');
            try {
                decodedMsg[arr[0].replace(/@S/g, '\/').replace(/@A/g, '@')] = arr[1].replace(/@S/g, '').replace(/@A/g, '');
            }
            catch(e) {
                console.log(arr[0]);
                console.log(arr[1]);
            }
        }
        // console.log(decodedMsg);
        formatData(decodedMsg);
    }
}

function formatData(info) {
    // console.log(info);
    switch (info.type) {
        case 'loginres':
            console.log('已登录...');
            break;
        // keep alive
        case 'mrkl':
            console.log('alive');
            break;
        // 开播
        case 'rss':
            console.log(info);
            break;
        // 主播等级经验相关
        case 'synexp':
            // console.log(`主播等级: <${info.o_lev}> 级`);
            break;
        case 'chatmsg':
        // case 'tsgs':
            unsavedBarrages.push({
                uid: info.uid,
                user: info.nn,
                txt: info.txt,
                level: info.level,
                bnn: info.bnn,
                bl: info.bl,
                time: dateFormat('YYYY-mm-dd HH:MM:SS', new Date())
            });
            // console.log(`[${info.nn}]:${info.txt}`);
            // console.log(chalk.rgb(200, 200, 200).bold.bgRgb(0, 0, 0)(info.nn + ':' + info.txt));
            break;
        // 广播信息
        case 'gbroadcast':
            break;
        // 禁言信息
        case 'newblackres':
            unsavedBans.push({
                did: info.did,
                sid: info.sid,
                dnic: info.dnic,
                snic: info.snic,
                endtime: formatTime(info.endtime),
                time: dateFormat('YYYY-mm-dd HH:MM:SS', new Date())
            });
            console.log(chalk.rgb(255, 255, 0).bold.bgRgb(0, 0, 0)(`<${info.dnic}> 被房管 <${info.snic}> 禁言到 ${formatTime(info.endtime)}`));
            break;
        // 无意义弹幕
        case 'blab':
            // if (info.nn && info.txt) {
            //     console.log(`用户 <${info.nn}> 发言 <${info.txt}> 被系统判为无意义弹幕`);
            // }
            break;
        // 系统屏蔽弹幕
        case 'qausrespond':
            // if (info.nn && info.txt) {
            //     console.log(`用户 <${info.nn}> 发言 <${info.txt}> 被屏蔽`);
            // }
            break;
        // 游客
        case 'srres':
            break;
        // 广告????
        case 'spbc':
            break;
        // 升级
        case 'upgrade':
            // console.log(`用户 <${info.nn}> 等级升到了 ${info.level} 级`);
            break;
        // 用户进入
        case 'uenter':
            // console.log(`用户 <${info.nn}> 进入房间`);
            break;
        // 房间人员信息
        case 'noble_num_info':
            // console.log(`当前房间有 ${info.vn} 人,贵族 ${info.sum} 人`);
            break;
        // 礼物信息
        case 'dgb':
        case 'rtss_update':
        case 'rtss_complete':
        case 'tsboxb':
        case 'mfcdopen':
            console.log(info)
            if (roomGift[info.gfid]) {
                if (info.bg) {
                    console.log(chalk.rgb(220, 137, 27).bold.bgRgb(0, 0, 0)(`用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${roomGift[info.gfid].name}>>>,共 ${info.hits} 个`));
                }
                else {
                    console.log(chalk.rgb(255, 0, 0).bold.bgRgb(0, 0, 0)(`用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${roomGift[info.gfid].name}>>>,共 ${info.hits} 个`));
                }
                broadcast(sockets, {
                    msg: `用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${roomGift[info.gfid].name}>>>,共 ${info.hits} 个`,
                    bg: info.bg
                });
            }
            else if (info.pid) {
                if (singleGift[info.pid]) {
                    if (info.bg) {
                        console.log(chalk.rgb(220, 137, 27).bold.bgRgb(0, 0, 0)(`用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${singleGift[info.pid].name}>>>,共 ${info.hits} 个`));
                        broadcast(sockets, {
                            msg: `用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${singleGift[info.pid].name}>>>,共 ${info.hits} 个`,
                            bg: info.bg
                        });
                    }
                    else {
                        console.log(chalk.rgb(255, 0, 0).bold.bgRgb(0, 0, 0)(`用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${singleGift[info.pid].name}>>>,共 ${info.hits} 个`));
                        broadcast(sockets, {
                            msg: `用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${singleGift[info.pid].name}>>>,共 ${info.hits} 个`,
                            bg: info.bg
                        });
                    }
                }
                else {
                    request(`${SINGLE_GIFT_URL}?pid=${info.pid}`, (err, res, body) => {
                        if (err) {
                            console.log(err);
                        }
                        else {
                            let singleGiftJson = JSON.parse(body);
                            singleGift[info.pid] = singleGiftJson.data;
                            if (info.bg) {
                                console.log(chalk.rgb(220, 137, 27).bold.bgRgb(0, 0, 0)(`用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${singleGift[info.pid].name}>>>,共 ${info.hits} 个`));
                                broadcast(sockets, {
                                    msg: `用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${singleGift[info.pid].name}>>>,共 ${info.hits} 个`,
                                    bg: info.bg
                                });
                            }
                            else {
                                console.log(chalk.rgb(255, 0, 0).bold.bgRgb(0, 0, 0)(`用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${singleGift[info.pid].name}>>>,共 ${info.hits} 个`));
                                broadcast(sockets, {
                                    msg: `用户 <${info.nn}> 赠送了 ${info.gfcnt} * ${info.bcnt} 连击 <<<${singleGift[info.pid].name}>>>,共 ${info.hits} 个`,
                                    bg: info.bg
                                });
                            }
                        }
                    });
                }
            }
            break;
        // 榜单变化
        case 'rank_change':
            break;
        default:
            // console.log(info);
            break;
    }
}

// 把单条弹幕存入数据库
function insertBarrageList(list) {
    let addSql = `INSERT INTO ${BARRAGE_TABLE_NAME}(uid,user,txt,level,bnn,bl,time) VALUES(?,?,?,?,?,?,?)`;
    list.forEach(item => {
        let data = [item.uid, item.user, item.txt, item.level, item.bnn, item.bl, item.time];
        connection.query(addSql, data, function (err, result) {
            if (err) {
                console.log('[Barrage INSERT ERROR] - ', err.message);
                console.log(item.user + ':' + item.txt);
                return;
            }
        });
    });
}

// 把单条禁言信息存入数据库
function insertBanList(list) {
    let addSql = `INSERT INTO ${BANS_TABLE_NAME}(did,sid,dnic,snic,endtime,time) VALUES(?,?,?,?,?,?)`;
    list.forEach(item => {
        let data = [item.did, item.sid, item.dnic, item.snic, item.endtime, item.time];
        connection.query(addSql, data, function (err, result) {
            if (err) {
                console.log('[Ban INSERT ERROR] - ', err.message);
                return;
            }
        });
    });
}

setInterval(() => {
    let insertData = [];
    if (unsavedBarrages.length === 0) {
        return;
    }
    else if (unsavedBarrages.length <= INSERT_NUMBER) {
        insertData = unsavedBarrages.splice(0, unsavedBarrages.length);
    }
    else{
        insertData = unsavedBarrages.splice(0, INSERT_NUMBER);
    }
    insertBarrageList(insertData);
    setTimeout(() => {
        insertBanList(unsavedBans.splice(0));
    }, 1000);
}, 3 * 1000);

ws.on('open', () => {
    console.log(`已连接到 ${ROOM_ID} 房间......`);
    let login_msg = `type@=loginreq/room_id@=${ROOM_ID}/dfl@=sn@A=105@Sss@A=1/username@=${USERNAME}/uid@=${UID}/ver@=20190610/aver@=218101901/ct@=0/`;
    ws.send(encode(login_msg));
    let join_group_msg = `type@=joingroup/rid@=${ROOM_ID}/gid@=1/`;
    ws.send(encode(join_group_msg));
    let heartbeat_msg = 'type@=mrkl/';
    ws.send(encode(heartbeat_msg));
    setInterval(() => {
        ws.send(encode(heartbeat_msg));
    }, 45 * 1000);
});

ws.on('message', (data) => {
    decode(data);
});


ws.on('close', () => {
    console.log('disconnected');
});