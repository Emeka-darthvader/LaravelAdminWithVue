export default class barrier {
    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.role ==="admin";
    }
    isAdminOrBusiness(){
        if(this.user.role === "admin" || this.user.role === "business"){

            return true;
        }
    }
    isBusiness(){
        return this.user.role ==="business";
    }
    isRegular(){
        return this.user.role ==="regular";
    }
    isAcquaintance(){
        return this.user.role ==="acquaintance";
    }
}