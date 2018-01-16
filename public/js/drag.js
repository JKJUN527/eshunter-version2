var Common = {
            getEvent: function() {//ie/ff
                if (document.all) {
                    return window.event;
                }
                func = getEvent.caller;
                while (func != null) {
                    var arg0 = func.arguments[0];
                    if (arg0) {
                        if ((arg0.constructor == Event || arg0.constructor == MouseEvent) || (typeof (arg0) == "object" && arg0.preventDefault && arg0.stopPropagation)) {
                            return arg0;
                        }
                    }
                    func = func.caller;
                }
                return null;
            },
            getMousePos: function(ev) {
                if (!ev) {
                    ev = this.getEvent();
                }
                if (ev.pageX || ev.pageY) {
                    return {
                        x: ev.pageX,
                        y: ev.pageY
                    };
                }

                if (document.documentElement && document.documentElement.scrollTop) {
                    return {
                        x: ev.clientX + document.documentElement.scrollLeft - document.documentElement.clientLeft,
                        y: ev.clientY + document.documentElement.scrollTop - document.documentElement.clientTop
                    };
                }
                else if (document.body) {
                    return {
                        x: ev.clientX + document.body.scrollLeft - document.body.clientLeft,
                        y: ev.clientY + document.body.scrollTop - document.body.clientTop
                    };
                }
            },
            getElementPos: function(el) {
                el = this.getItself(el);
                var _x = 0, _y = 0;
                do {
                    _x += el.offsetLeft;
                    _y += el.offsetTop;
                } while (el = el.offsetParent);
                return { x: _x, y: _y };
            },
            getItself: function(id) {
                return "string" == typeof id ? document.getElementById(id) : id;
            },
            getViewportSize: { w: (window.innerWidth) ? window.innerWidth : (document.documentElement && document.documentElement.clientWidth) ? document.documentElement.clientWidth : (document.body?document.body.offsetWidth:0), h: (window.innerHeight) ? window.innerHeight : (document.documentElement && document.documentElement.clientHeight) ? document.documentElement.clientHeight : (document.body ? document.body.offsetHeight : 0) },
            isIE: document.all ? true : false,
            setOuterHtml: function(obj, html) {
                var Objrange = document.createRange();
                obj.innerHTML = html;
                Objrange.selectNodeContents(obj);
                var frag = Objrange.extractContents();
                obj.parentNode.insertBefore(frag, obj);
                obj.parentNode.removeChild(obj);
            },
            firstChild: function(parentObj, tagName) {
                if (Common.isIE) {
                    return parentObj.firstChild;
                }
                else {
                    var arr = parentObj.getElementsByTagName(tagName);
                    return arr[0];
                }
            },
            lastChild: function(parentObj, tagName) {
                if (Common.isIE) {
                    return parentObj.lastChild;
                }
                else {
                    var arr = parentObj.getElementsByTagName(tagName);
                    return arr[arr.length - 1];
                }
            },
            setCookie: function(name, value) {
                document.cookie = name + "=" + value;
            },
            getCookie: function(name) {
                var strCookie = document.cookie;
                var arrCookie = strCookie.split("; ");
                for (var i = 0; i < arrCookie.length; i++) {
                    var arr = arrCookie[i].split("=");
                    if (!arr[1]) {
                        return "";
                    }
                    if (arr[0] == name) {
                        return arr[1];
                    }
                }
                return "";
            },
            delCookie: function(name) {
                var exp = new Date();
                exp.setTime(exp.getTime() - 1);
                var cval = this.getCookie(name);
                if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
            }
        }
        var Class = {
            create: function() {
                return function() { this.init.apply(this, arguments); }
            }
        }
        var Drag = Class.create();
        Drag.prototype = {
            init: function(titleBar, dragDiv, Options) {
                //设置点击是否透明，默认透明60%
                titleBar = Common.getItself(titleBar);
                dragDiv = Common.getItself(dragDiv);
                this.dragArea = { maxLeft: -9999, maxRight: 9999, maxTop: -9999, maxBottom: 9999 };
                if (Options) {
                    this.opacity = Options.opacity ? (isNaN(parseInt(Options.opacity)) ? 100 : parseInt(Options.opacity)) : 100;
                    if (Options.area) {
                        if (Options.area.left && !isNaN(parseInt(Options.area.left))) { this.dragArea.maxLeft = Options.area.left };
                        if (Options.area.right && !isNaN(parseInt(Options.area.right))) { this.dragArea.maxRight = Options.area.right };
                        if (Options.area.top && !isNaN(parseInt(Options.area.top))) { this.dragArea.maxTop = Options.area.top };
                        if (Options.area.bottom && !isNaN(parseInt(Options.area.bottom))) { this.dragArea.maxBottom = Options.area.bottom };
                    }
                }
                else {
                    this.opacity = 60;
                }
                this.originDragDiv = null;
                this.tmpX = 0;
                this.tmpY = 0;
                this.moveable = false;
                this.dragArray = [];

                var dragObj = this;
                var dragTbl = document.getElementById("dragTable");

                titleBar.onmousedown = function(e) {
                    var ev = e || window.event || Common.getEvent();
                    //只允许通过鼠标左键进行拖拽,IE鼠标左键为1 FireFox为0
                    if (Common.isIE && ev.button == 1 || !Common.isIE && ev.button == 0) {
                    }
                    else {
                        return false;
                    }

                    //处理特殊情况：在最上/下面MOVE时不碰到现有DIV的情况下，又回到起始拖拽的列最上/下方
                    var tmpColId;
                    for (c = 0; c < dragTbl.rows[0].cells.length; c++) {
                        for (k = 0; k < dragTbl.rows[0].cells[c].getElementsByTagName("DIV").length; k++) {
                            if (dragDiv.id == dragTbl.rows[0].cells[c].getElementsByTagName("DIV")[k].id) {
                                tmpColId = c;
                                break;
                            }
                        }
                    }
                    var tmpPosFirstChild = Common.getElementPos(Common.firstChild(dragTbl.rows[0].cells[tmpColId], "DIV"));
                    var tmpPosLastChild = Common.getElementPos(Common.lastChild(dragTbl.rows[0].cells[tmpColId], "DIV"));
                    var tmpObj = { colId: tmpColId, firstChildUp: tmpPosFirstChild.y, lastChildDown: tmpPosLastChild.y + Common.lastChild(dragTbl.rows[0].cells[tmpColId], "DIV").offsetHeight };

                    //保存当前可拖拽各容器的所在位置
                   dragObj.dragArray = dragObj.RegDragsPos();

                    //插入虚线框
                    var dashedElement = document.createElement("div");
                    dashedElement.style.cssText = dragDiv.style.cssText;
                    dashedElement.style.border = " dashed 2px #aaa ";
                    dashedElement.style.marginBottom = "6px";
                    dashedElement.style.width = dragDiv.offsetWidth - 2 * parseInt(dashedElement.style.borderWidth) + "px"; //减去boderWidth使虚线框大小保持与dragDiv一致
                    dashedElement.style.height = dragDiv.offsetHeight - 2 * parseInt(dashedElement.style.borderWidth) + "px"; //加上px 保证FF正确                    
                    dashedElement.style.position = "relative";
                    if (dragDiv.nextSibling) {
                        dragDiv.parentNode.insertBefore(dashedElement, dragDiv.nextSibling);
                    }
                    else {
                        dragDiv.parentNode.appendChild(dashedElement);
                    }
                    //拖动时变为absolute
                    dragDiv.style.width = dragDiv.offsetWidth + "px";
                    dragDiv.style.position = "absolute";


                    dragObj.moveable = true;
                    dragDiv.style.zIndex = dragObj.GetZindex() + 1;

                    var downPos = Common.getMousePos(ev);
                    dragObj.tmpX = downPos.x - dragDiv.offsetLeft;
                    dragObj.tmpY = downPos.y - dragDiv.offsetTop;

                    if (Common.isIE) {
                        dragDiv.setCapture();
                    } else {
                        window.captureEvents(Event.mousemove);
                    }

                    dragObj.SetOpacity(dragDiv, dragObj.opacity);

                    //FireFox 去除容器内拖拽图片问题
                    if (ev.preventDefault) {
                        ev.preventDefault();
                        ev.stopPropagation();
                    }

                    document.onmousemove = function(e) {
                        if (dragObj.moveable) {
                            var ev = e || window.event || Common.getEvent();
                            //IE 去除容器内拖拽图片问题
                            if (document.all) //IE
                            {
                                ev.returnValue = false;
                            }

                            var movePos = Common.getMousePos(ev);
                            dragDiv.style.left = Math.max(Math.min(movePos.x - dragObj.tmpX, dragObj.dragArea.maxRight), dragObj.dragArea.maxLeft) + "px";
                            dragDiv.style.top = Math.max(Math.min(movePos.y - dragObj.tmpY, dragObj.dragArea.maxBottom), dragObj.dragArea.maxTop) + "px";

                            var targetDiv = null;
                            for (var k = 0; k < dragObj.dragArray.length; k++) {
                                if (dragDiv == dragObj.dragArray[i]) {
                                    continue;
                                }

                                if (movePos.x > dragObj.dragArray[k].PosLeft && movePos.x < dragObj.dragArray[k].PosLeft + dragObj.dragArray[k].PosWidth
                                    && movePos.y > dragObj.dragArray[k].PosTop && movePos.y < dragObj.dragArray[k].PosTop + dragObj.dragArray[k].PosHeight
                                ) {
                                    targetDiv = document.getElementById(dragObj.dragArray[k].DragId);
                                    if (movePos.y < dragObj.dragArray[k].PosTop + dragObj.dragArray[k].PosHeight / 2) {
                                        //往上移
                                        dashedElement.style.width = targetDiv.offsetWidth - 2 * parseInt(dashedElement.style.borderWidth) + "px";
                                        targetDiv.parentNode.insertBefore(dashedElement, targetDiv);
                                    }
                                    else {
                                        //往下移
                                        dashedElement.style.width = targetDiv.offsetWidth - 2 * parseInt(dashedElement.style.borderWidth) + "px";
                                        if (targetDiv.nextSibling) {
                                            targetDiv.parentNode.insertBefore(dashedElement, targetDiv.nextSibling);
                                        }
                                        else {
                                            targetDiv.parentNode.appendChild(dashedElement);
                                        }
                                    }
                                }
                            }
                            
                            for (j = 0; j < dragTbl.rows[0].cells.length; j++) {
                                var startLeft = Common.getElementPos(dragTbl.rows[0].cells[j]).x;
                                if (movePos.x > startLeft && movePos.x < startLeft + dragTbl.rows[0].cells[j].offsetWidth) {
                                    ///列无DIV
                                    if (dragTbl.rows[0].cells[j].getElementsByTagName("div").length == 0) {
                                        dashedElement.style.width = dragTbl.rows[0].cells[j].offsetWidth - 2 * parseInt(dashedElement.style.borderWidth) + "px";
                                        dragTbl.rows[0].cells[j].appendChild(dashedElement);
                                    }
                                    else {
                                        var posFirstChild = Common.getElementPos(Common.firstChild(dragTbl.rows[0].cells[j], "DIV"));
                                        var posLastChild = Common.getElementPos(Common.lastChild(dragTbl.rows[0].cells[j], "DIV"));
                                        //处理特殊情况：在最上/下面MOVE时不碰到现有DIV的情况下，又回到起始拖拽的列最上/下方
                                        var tmpUp, tmpDown;
                                        if (tmpObj.colId == j) {
                                            tmpUp = tmpObj.firstChildUp;
                                            tmpDown = tmpObj.lastChildDown;
                                        }
                                        else {
                                            tmpUp = posFirstChild.y;
                                            tmpDown = posLastChild.y + Common.lastChild(dragTbl.rows[0].cells[j], "DIV").offsetHeight;
                                        }

                                        if (movePos.y < tmpUp) {///从最上面插入虚线框
                                            dashedElement.style.width = Common.firstChild(dragTbl.rows[0].cells[j], "DIV").offsetWidth - 2 * parseInt(dashedElement.style.borderWidth) + "px";
                                            dragTbl.rows[0].cells[j].insertBefore(dashedElement, Common.firstChild(dragTbl.rows[0].cells[j], "DIV"));
                                        }
                                        else if (movePos.y > tmpDown) {///从最下面插入虚线框
                                            dashedElement.style.width = Common.lastChild(dragTbl.rows[0].cells[j], "DIV").offsetWidth - 2 * parseInt(dashedElement.style.borderWidth) + "px";
                                            dragTbl.rows[0].cells[j].appendChild(dashedElement);
                                        }

                                    }
                                }
                            }
                        }
                    };

                    document.onmouseup = function() {
                        if (dragObj.moveable) {
                            if (Common.isIE) {
                                dragDiv.releaseCapture();
                            }
                            else {
                                window.releaseEvents(dragDiv.mousemove);
                            }
                            dragObj.SetOpacity(dragDiv, 100);
                            dragObj.moveable = false;
                            dragObj.tmpX = 0;
                            dragObj.tmpY = 0;

                            //务必写在此IF内
                            dragDiv.style.left = "";
                            dragDiv.style.top = "";
                            dragDiv.style.width = "";
                            dragDiv.style.position = "";  
                            dashedElement.parentNode.insertBefore(dragDiv, dashedElement);
                            dashedElement.parentNode.removeChild(dashedElement);
                            modularSort();
                        }

                    };

                }
            },
            SetOpacity: function(dragDiv, n) {
                if (Common.isIE) {
                    // dragDiv.filters.alpha.opacity = n;
                }
                else {
                    dragDiv.style.opacity = n / 100;
                }

            },
            GetZindex: function() {
                var maxZindex = 0;
                var divs = document.getElementsByTagName("div");
                for (z = 0; z < divs.length; z++) {
                    maxZindex = Math.max(maxZindex, divs[z].style.zIndex);
                }
                return maxZindex;
            },
            RegDragsPos: function() {
                var arrDragDivs = new Array();
                var dragTbl = document.getElementById("dragTable");
                var tmpDiv, tmpPos;
                for (i = 0; i < dragTbl.getElementsByTagName("div").length; i++) {
                    tmpDiv = dragTbl.getElementsByTagName("div")[i];
                    if (tmpDiv.className == "dragDiv") {
                        tmpPos = Common.getElementPos(tmpDiv);
                        arrDragDivs.push({ DragId: tmpDiv.id, PosLeft: tmpPos.x, PosTop: tmpPos.y, PosWidth: tmpDiv.offsetWidth, PosHeight: tmpDiv.offsetHeight });
                    }
                }
                return arrDragDivs;
            }
        }

        window.onload = function() {
             var dragTbl = document.getElementById("dragTable"); //|| Common.getCookie("configArr") == ""
            if (Common.getCookie("configArr") == undefined) {
                var configArr = eval("0,(" + Common.getCookie("configArr") + ")");
                // eval("(0," + s + ")");  
                for (i = 0; i < dragTbl.rows[0].cells.length; i++) {
                    for (j = 0; j < configArr[i].length; j++) {
                        dragTbl.rows[0].cells[i].appendChild(document.getElementById(configArr[i][j]));
                    }
                }
            }
            new Drag("titleBar1", "dragDiv1");
            new Drag("titleBar2", "dragDiv2");
            new Drag("titleBar3", "dragDiv3");
            new Drag("titleBar4", "dragDiv4");
            new Drag("titleBar5", "dragDiv5");
            new Drag("titleBar6", "dragDiv6");
            new Drag("titleBar7", "dragDiv7");
        }

        window.onunload = function() {
            var dragTbl = document.getElementById("dragTable");
            var configArr = "";
            for (i = 0; i < dragTbl.rows[0].cells.length; i++) {
                var tmpStr = "";
                for (j = 0; j < dragTbl.rows[0].cells[i].getElementsByTagName("DIV").length; j++) {
                    tmpStr += (tmpStr == "" ? "" : ",") + "'" + dragTbl.rows[0].cells[i].getElementsByTagName("DIV")[j].id + "'";
                }
                configArr += (configArr == "" ? "" : ",") + "[" + tmpStr + "]";
            }
            //format like: [['dragDiv3','dragDiv5'],['dragDiv4','dragDiv1'],['dragDiv2']]
            Common.setCookie("configArr", "[" + configArr + "]");            
        }