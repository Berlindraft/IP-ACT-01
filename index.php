<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #0056b3;
            text-align: center;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            text-align: center;

        }
        .temperature {
            text-align: center;
            font-size: 1.5em;
            margin-top: 20px;
        }
        .weather-gif-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .weather-gif {
            width: 400px; 
        }
        .refresh-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Weather Report</h1>

    <?php
    // Weather array
    $weather = array("rain", "sunshine", "clouds", "hail", "sleet", "snow", "wind");

    $weather_statement = "We've seen all kinds of weather this month. At the beginning of the month, we had " . 
                      $weather[5] . " and " . $weather[6] . ". Then came " . 
                      $weather[1] . " with a few " . $weather[2] . " and some " . 
                      $weather[0] . ". At least we didn't get any " . $weather[3] . 
                      " or " . $weather[4] . ".";

    echo "<p>$weather_statement</p>";
    ?>
    
    <div class="weather-gif-container">
        <img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExczFwa2djajFrYTZmd2JsMmIxZW5jYnkxZm90ZjNvbjdva2pqem5jbiZlcD12MV9pbnRlcm5naWZfYnlfaWQmY3Q9Zw/4sO3Aktjk6myb6Jx5S/giphy.gif" alt="Weather GIF" class="weather-gif">
    </div>
    <div class="temperature" id="temperature">Loading temperature...</div>
    <button class="refresh-button" onclick="location.reload();">Refresh</button>

    <script>
        const myHeaders = new Headers();
        myHeaders.append("x-apihub-key", "X3u9d7SxI1hXoUOnPCrmmrYs0SkXpheuSKPQcyW9Bl3pVp6un8");
        myHeaders.append("x-apihub-host", "All-in-One-Weather-API.allthingsdev.co");
        myHeaders.append("x-apihub-endpoint", "2cd1a1f6-4f7f-4cd9-929e-3ce96b929bae");

        const requestOptions = {
            method: "GET",
            headers: myHeaders,
            redirect: "follow"
        };

        fetch("https://All-in-One-Weather-API.proxy-production.allthingsdev.co/v1/current.json?q=Cebu", requestOptions)
            .then((response) => response.json())
            .then((result) => {
                console.log(result); 
                if (result && result.current && result.current.temp_c) {
                    document.getElementById("temperature").innerText = `Current temperature in Cebu: ${result.current.temp_c}°C`;
                } else {
                    document.getElementById("temperature").innerText = "Unable to fetch temperature data.";
                }
            })
            .catch((error) => {
                console.error(error);
                document.getElementById("temperature").innerText = "Unable to fetch temperature data.";
            });
    </script>

</body>
</html>
