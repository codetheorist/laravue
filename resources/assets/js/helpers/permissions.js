import store from './../store/index.js'

export default {
    userCan(token) {
        if (!token) {
            return false
        }
        let userPerms = store.state.auth.user.permissions
        if(userPerms) {
            // console.log(userPerms)
            if (!Array.isArray(token)) {
                if (userPerms.indexOf(token) !== -1) {
                    return 1
                } else {
                    return false
                }
            } else {
                token.forEach(function(perm){
                    console.log(perm)
                    if (userPerms.indexOf(perm) !== -1) {
                        console.log('True')
                        return 1
                    } else {
                        return false
                    }
                })
            }
        }
    }
}
