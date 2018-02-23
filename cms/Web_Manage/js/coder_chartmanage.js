CODER.Util.ChartManage = function () {
    /*
    item參數
    id:DOM ID
    type:表格類型(折線:line)
    dataEvent:原始資料轉換表格資料的function
    hoverFormat:啟用plothover事件,格式化要回傳的內容
    */
    var items = [];
    
    //暫存,用來判斷重複hover
    var previousPoint = null;
    return {
        //是否在console顯示debug資訊
        debug:false,
        add: function (item) {
            if (this.chkitem(item) == true) {
                items.push(item);
            }
        },
        show: function (data, autosize) {
            autosize = autosize || false;
            var count = data.length;
            for (var i = 0, c = items.length; i < c; i++) {
                this.chksize(items[i], count, autosize);
                var options = {};
                var def_data = {};
                var resizeBar = false;
               
                switch (items[i].type) {
                    case "line":
                        options = this.getLinePlotOptions();
                        break;
                    case "bar":
                        options = this.getBarPlotOptions();
                        resizeBar = true;
                        break;
                    case "orderBars":
                        options = this.getOrderBarPlotOptions();
                        resizeBar = true;
                        break;
                    case "pie":
                        options = this.getPiePlotOptions();
                        break;
                    case "barLine":
                        var settings = this.getbarLinePlotSettings();
                        options = settings.options;
                        def_data = settings.def_data;
                        resizeBar = true;
                        break;
                }
                var _data = items[i].dataEvent(items[i], data, options, def_data);
                if (resizeBar && count < 3) {
                    options.xaxis.min = -1 + (count-1)*0.5;
                    options.xaxis.max = 1 + (count/2 - 0.5);
                }
                var plot = $.plot($("#" + items[i].id), _data, options);               
                this.bindEvent(items[i]);
            }
        },
        chkitem: function (item) {
            if (!item.id || item.id == "undefined" || item.id == "") {
                this.oops('item.id未設定');
                return false;
            }
            if ($("#" + item.id).size() == 0) {
                this.oops('查無item.id物件');
                return false;
            }

            if (!item.type || item.type == "undefined" ) {
                this.oops('item.type未設定');
                return false;
            }
            if ( typeof (item.dataEvent) != "function") {
                this.oops('item.dataEvent必須為function' );
                return false;
            }
            return true;
        },
        chksize: function (item, length, autosize) {
            var container = $('#' + item.id + "_container");
            if (!autosize) {
                if (length < 12) {
                    container.attr("class", "col-md-6");
                }
                else {
                    container.attr("class", "col-md-12");
                }
            }
        },
        oops: function (str) {
            if (this.debug == true) {
               // console.log("ChartManage:"+str);
            }
        }
        ,
        getLinePlotOptions: function () {
            var options = {
                series: {
                    lines: {
                        show: true,
                        lineWidth: 2,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.05
                            }, {
                                opacity: 0.01
                            }]
                        }
                    },
                    points: {
                        show: true
                    },
                    shadowSize: 2

                },
                grid: {
                    show: true,
                    aboveData: true,
                    color: "#3f3f3f",
                    labelMargin: 5,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 20
                },
                legend:
                {
                    noColumns: 0
                },
                //colors: ["#FCB322", "#A5D16C", "#52e136"]
            };
            return options;
        }
        , getBarPlotOptions: function () {
            var options = {
                series: {
                    stack: 0,
                    bars: {
                        show: true,
                        barWidth: 0.5,
                        lineWidth: 2,
                        align: 'center',
                        fill: 0.8
                    }

                },
                grid: {
                    show: true,
                    aboveData: false,
                    color: "#3f3f3f",
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true
                },
                legend:
                 {
                     noColumns: 0
                 },
                xaxis:
                 {
                     
                 }
            }
            return options;
        }
        , getOrderBarPlotOptions: function () {
            var options = {
                bars: {
                    show: true,
                    barWidth: 0.2,
                    order: 1,
                    lineWidth: 1,
                    fill: 0.8
                },
                grid: {
                    show: true,
                    aboveData: false,
                    color: "#3f3f3f",
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                },
                legend:
                 {
                     noColumns: 0
                 },
                xaxis:
                 {
                    
                 }
            }
            return options;
        }
        , getPiePlotOptions: function () {
            var options = {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            adius: 3 / 4,
                            formatter: function(label, series) {
                                return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: {
                                opacity: 0.5,
                                color: '#000'
                            }
                        }
                    }
                },
                grid: {
                    show: true,
                    clickable: true,
                    hoverable: true,
                }
            }
            return options;
        },
        getbarLinePlotSettings: function () {
            var options = {
                series: {
                    stack: true, // is stackable?
                    shadowSize: 2 // is the default size of shadows in pixels. Set it to 0 to remove shadows
                },
                grid: {
                    show: true,
                    hoverable: true, // once hover, it will highlight
                    clickable: true
                },
                legend:
                 {
                     noColumns: 0
                 }
            };

            var bar_setting = (this.getBarPlotOptions()).series;
            var line_setting = (this.getLinePlotOptions()).series;
            return {
                options: options,
                def_data: {
                    bar: bar_setting,
                    line: line_setting
                }
            };
        }
        , showTooltip: function (x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 15,
                border: '1px solid #333',
                padding: '4px',
                color: '#fff',
                'border-radius': '3px',
                'background-color': '#333',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        },
        bindEvent: function (item) {          
            var parent = this;
            if (typeof(item.hoverFormat) == "function") {
                $("#" + item.id).bind("plothover", { parent: parent, item: item }, function (event, pos, item) {
                    if (item) {
                        if (previousPoint != item.series.label + item.dataIndex) {
                            previousPoint = item.series.label + item.dataIndex;
                            $("#tooltip").remove();
                            event.data.parent.showTooltip(item.pageX, item.pageY, event.data.item.hoverFormat(item));
                        }
                    } else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }
            if (typeof (item.clickEvent) == "function") {
               
                $("#" + item.id).bind("plotclick",{ parent: parent,item:item}, function (event, pos, item) {
                    if (item) {
                        event.data.item.clickEvent(item);
                    }
                });
            }
        }
    }
    
}
