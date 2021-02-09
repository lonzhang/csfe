import { Base64 } from 'js-base64'

let salting = 'csfe-base'
// 加密
const encryptString = (name) => {
    name = typeof name == "object" ? JSON.stringify(name) : name;
    return Base64.encode(name + salting)
}

// 解密
const decodeString = (name) => {
    let decodeName = Base64.decode(name) || ''
    if (decodeName && decodeName.split && decodeName.split(salting) && decodeName.split(salting)[0]) {
        let Obj = decodeName.split(salting)[0];
        Obj = Obj.indexOf('{') != -1 ? JSON.parse(Obj) : Obj;
        return Obj
    } else {
        return ''
    }
}

const getUrlQuery = (name) => {
    let url = name.match(/\?(\S*)/)[1];
    return decodeString(url);
}


export { encryptString, decodeString, getUrlQuery }
