<!DOCTYPE html>
<html>
<head>
    <title>Bing Maps Test</title>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <!-- Add debugging styles -->
    <style>
        #myMap { 
            position: relative;
            width: 100%;
            height: 400px;
            background: #f0f0f0;
        }
        #debugInfo {
            margin: 10px;
            padding: 10px;
            background: #fff;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div id="debugInfo">Map Status: <span id="status">Loading...</span></div>
    <div id="myMap"></div>

    <script>
        function loadMapScenario() {
            try {
                document.getElementById('status').innerText = 'Initializing map...';
                
                var map = new Microsoft.Maps.Map('#myMap', {
                    credentials: 'Aiv3JsF7s-z-4EFCQPXQF7w8aGHAUNfZgfaUw_0BNCKCWLt2rV37yy8aw0xoz7lh',
                    center: new Microsoft.Maps.Location(-6.200000, 106.816666),
                    zoom: 12
                });

                // Add a test pin
                var center = map.getCenter();
                var pin = new Microsoft.Maps.Pushpin(center, {
                    title: 'Test Pin',
                    subTitle: 'Jakarta'
                });
                map.entities.push(pin);

                document.getElementById('status').innerText = 'Map loaded successfully!';
            } catch (e) {
                document.getElementById('status').innerText = 'Error: ' + e.message;
                console.error('Map error:', e);
            }
        }
    </script>
    <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=Aiv3JsF7s-z-4EFCQPXQF7w8aGHAUNfZgfaUw_0BNCKCWLt2rV37yy8aw0xoz7lh&callback=initializeMap' async defer></script>
</body>
</html>