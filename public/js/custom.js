function f1() {
    var hometab = document.querySelector('#hometabid');
    var nouvprestab = document.querySelector('#nouvpresid');
    var menu1tab = document.querySelector('#menu1id');

    var hometabclasstype = hometab.className;
    var nouvprestabclasstype = nouvprestab.className;
    var menu1tabclasstype = menu1tab.className;

    var hometabcheckactive = hometabclasstype.includes('active');
    var nouvprescheckactive = nouvprescasstype.includes('active');
    if (hometabclasstype === 'active') {
        hometab.style.border = "1px solid blue";
        nouvprestab.style.border = "none";
        menu1tab.style.border = "none";
    }

    if (nouvprestabclasstype === 'active') {
        hometab.style.border = "none";
        alert('1');
        nouvprestab.style.border = "1px solid blue";
        menu1tab.style.border = "none";
    }

    if (menu1tabclasstype === 'active') {
        hometab.style.border = "none";
        nouvprestab.style.border = "none";
        menu1tab.style.border = "1px solid blue";
    }





}