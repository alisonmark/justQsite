function myFunction() {
    // Khai báo 1 đối tượng mới
    // Giống với class trong các ngôn ngữ khác
    var animal = {
        // Khai báo thuộc tính
        name: "Động vật",
        age: 0,

        // Khai báo method
        spaeking: function() {
            var myLang = "Tôi là động vật nói chung";
            return myLang;
        }
    }
    var lstElement;
    lstElement = document.getElementById("c-mini-gallery__img");
    alert(lstElement);
    console.log(lstElement);
    console.log(lstElement.childElementCount);

}


function counting(skillPoints, xp, level) {
    var strength = 0.6 * skillPoints + 0.1 * xp;
    var agility = 0.2 * skillPoints + 0.2 * xp;
    var intel = 0.2 * skillPoints + 10 * level;

    var lst = new Array();
    lst.push(strength);
    lst.push(agility);
    lst.push(intel);
    return lst;
}