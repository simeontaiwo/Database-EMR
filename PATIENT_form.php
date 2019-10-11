<?php
$connection = mysqli_connect('localhost', 'root', '');
if(!$connection){
	die("Database Connection Failed" . mysqli_error($connection));
}
$selectdb = mysqli_select_db($connection, 'emr');
if(!$selectdb){
	die("Database Selection Failed" . mysqli_error($connection));
}

?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <style type="text/css">
        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;


        }

        input[type=submit] {
            width: 16%;
            padding: 14px 20px;
            margin: 8px 0px;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color:gray;


        }
        
        input[type=button] {
            width: 16%;
            padding: 14px 20px;
            margin: 8px 0px;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color:gray;


        }

        input[type=submit]:hover {
            background-color: red;
        }
        
        input[type=button]:hover {
            background-color: red;
        }

        .box {
            background-color: #f2f2f2;
            border-radius: 5px;
            padding: 40px;
            max-width: 70%;
            margin: 0 auto;

        }

        h3 {
            padding: 14px 20px;
            background-color: #f2f2f2;
            width: 400px;

        }

        label {
            display: block;
            font: 1rem 'Fira Sans', sans-serif;
        }

        input,
        label {
            margin: .4rem 0;
        }
    </style>
</head>

<body
    style="background-image: url(./images/nch_1.jpg); background-repeat: no-repeat; background-size: 100%; background-position: center;">



    <center>
        <h3>Patient form.</h3>
    </center>
    <marquee>
        <p style="color:rgb(100,250,150);">ELECTRONIC MEDICAL RECORD</p>
    </marquee>

    <div class="box">
        <form action="/formSubmit.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <label for="Title">title</label>
                        <select name="Title">
                            <option>select</option>
                            <option>prof</option>
                            <option>Dr</option>
                            <option>pharm</option>
                            <option>Rev</option>
                            <option>Mr</option>
                            <option>Mrs</option>
                            <option>Miss</option>
                        </select>
                    <label for="fname">firstName</label>
                    <input type="text" name="firstName" placeholder="firstName">
                    <label for="lname">lastName</label>
                    <input type="text" name="lastName" placeholder="LastName">
                    <label for="OtherName">otherName</label>

                    <input type="text" name="otherName" placeholder="OtherName">
                    <label for="gender">Gender</label>
                    <select name="gender">
                        <option>select</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <label for="Marrital_Status">Marrital_Status</label>
                    <select name="marrital_Status">
                        <option>select</option>
                        <option>Married</option>
                        <option>Single</option>
                        <option>Diovovice</option>
                        <option>separeted</option>
                    </select>
                    <label for="start">Date_of_Birth</label>

                <input type="date" id="start" name="trip-start" value="2018-07-22" min="1807-01-01" max="2090-12-31">   

                </div>
                <div class="col-md-6">
                    <label for="country">Country</label>
                    <!-- <select id="country" name="country" class="form-control"> -->
                    <select id="country-select" name="">
                    <option disabled selected>Please Select Country</option>
                    <?php
                    $sql = "SELECT * FROM countries";
                    $result = mysqli_query($connection, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                    <?php } ?>
                    </select>
                    <select id="state-select" name="state">
                    <option disabled selected>Please Select State</option>
                    </select>
                    <select id="city-select" name="city">
                    <option disabled selected>Please Select City</option>
                    </select>
                    <script type="text/javascript">
                    function getStatesSelectList(){
                    var country_select = document.getElementById("country-select");
                    var city_select = document.getElementById("city-select");

                    var country_id = country_select.options[country_select.selectedIndex].value;
                    console.log('CountryId : ' + country_id);

                    var xhr = new XMLHttpRequest();
                    var url = 'states.php?country_id=' + country_id;
                    // open function
                    xhr.open('GET', url, true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    // check response is ready with response states = 4
                    xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4 && xhr.status == 200){
                            var text = xhr.responseText;
                            //console.log('response from states.php : ' + xhr.responseText);
                            var state_select = document.getElementById("state-select");
                            state_select.innerHTML = text;
                            state_select.style.display='inline';
                            //city_select.style.display='none';
                        }
                    }

                    xhr.send();
                    }

                    function getCitySelectList(){
                    var state_select = document.getEltrip-startementById("state-select");

                    var state_id = state_select.options[state_select.selectedIndex].value;
                    console.log('StateId : ' + state_id);

                    var xhr = new XMLHttpRequest();
                    var url = 'cities.php?state_id=' + state_id;
                    // open function
                    xhr.open('GET', url, true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    // check response is ready with response states = 4
                    xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4 && xhr.status == 200){
                            var text = xhr.responseText;
                            //console.log('response from cities.php : ' + xhr.responseText);
                            var city_select = document.getElementById("city-select");
                            city_select.innerHTML = text;
                            city_select.style.display='inline';
                        }
                    }

                    xhr.send();
                    }

                    var country_select = document.getElementById("country-select");
                    country_select.addEventListener("change", getStatesSelectList);

                    var state_select = document.getElementById("state-select");
                    state_select.addEventListener("change", getCitySelectList);
                    </script>

                <label for="Identification">Identificatin</label>
                    <select name="Identification">
                        <option>select</option>
                        <option>National ID</option>
                        <option>Votes Card</option>
                        <option>Passport</option>
                        <option>School ID</option>
                    </select>

                    <label for="preferred_language">preferred_language</label>
                    <select name="preferred_language">
                        <option>select</option>
                        <option>ENGLISH</option>
                        <option>HAUSA</option>
                        <option>YORUBA</option>
                        <option>IGBO</option>
                        <option>OKUN</option>
                    </select>
                    <label for="genotype">Genotype</label>
                    <select name="Genotype">
                        <option>select</option>
                        <option>AA</option>
                        <option>AS</option>
                        <option>AC</option>
                        <option>SS</option>
                        <option>SC</option>
                    </select>
                    <label for="blood_group">blood_group</label>
                    <select name="bloood_group">
                        <option>select</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>0+</option>
                        <option>0-</option>
                    </select>


                </div>
            
            </div>
                    
            
            <input type='submit' value='Add'/>
            <input type='button' value='Reset'/>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>