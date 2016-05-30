(function(window, undefined){
    var w = {
        cec: {
            targets: [],
            init: function() {
                w.cec.targets = document.querySelectorAll('.wispiring-cec-combo');
                for (var i=0; i<w.cec.targets.length;i++) {
                    var selects = w.cec.targets[i].querySelectorAll('select');
                    for (var j=0; j<selects.length;j++) {
                        selects[j].addEventListener('change', w.cec.select);
                        if (selects[j+1]) {
                            selects[j].xiaoDi = selects[j+1];
                        }
                    }
                    w.cec.filterXiaoDi(selects[0], false);
                }
            },
            select: function(event) {
                w.cec.filterXiaoDi(event.target, true);
            },
            filterXiaoDi: function(ele, clearSelected) {
                var xd = ele.xiaoDi;
                if (xd) {
                    if (clearSelected) {
                        xd.selectedIndex = 0;
                    }
                    var ops = xd.options, parentValue = ele.options[ele.selectedIndex].value;
                    for (var i=1;i<ops.length;i++) {
                        ops[i].style.display = (ops[i].dataset.parent == parentValue) ? 'block' : 'none';
                    }
                    w.cec.filterXiaoDi(xd, clearSelected);
                }
            }
        }
    }
    window.wispiring = w;
})(window);
window.addEventListener('load', wispiring.cec.init);
