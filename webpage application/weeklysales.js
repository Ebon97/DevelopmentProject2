            var myData = [240, 680, 480, 105, 400, 700, 300];

            var myConfig = {
                "graphset": [{
                    "type": "bar",
                    "title": {
                        "text": "Sales of the Week"
                    },
                    "scale-x": {
                        "labels": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
                    },
                    "series": [{
                        "values": myData
                    }]
                }]
            };

            zingchart.render({
                id: 'weeklysales',
                data: myConfig,
                height: "100%",
                width: "100%"
            })