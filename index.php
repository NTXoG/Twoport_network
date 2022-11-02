<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Two Port Parameter</title>
    <style>
        body {
            background-color: #074f57;
            background-image: url("./img/3386851.jpg");
            background-blend-mode: multiply;
        }

        h1 {
            font-size: 5vh;
            color: #FFFFFF
        }

        p {
            font-size: 3vh;
            color: #FFFFFF
        }

        .input-group-text {
            background-color: #AA0000;
            color: #FFFFFF;
        }

        .header {
            background-color: #000066;
            padding: 10px;
            border-radius: 10px;
        }

        .logo {
            text-shadow: 2px 2px 4px #000000;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row header">
            <div class="col-sm-5 d-flex justify-content-center align-items-center logo"><img src="./img/LogoCCE.png" alt="CCE Logo" height="250px"></div>
            <div class="col-sm-7 text-header mt-sm-5 ml-2 ">
                <h1>Two Port Network Parameter</h1>
                <p>By Major Computer and Communication Enginearing UDRU</p>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="row">
            <div class="form col-md-6 d-flex justify-content-md-center">
                <div class="form-input">
                    <form class="row" id="form-cal">
                        <select name="parameter" class="form-select form-select-lg mb-3 mt-2" aria-label=".form-select-lg ">
                            <option value="0">Select Parameters</option>
                            <option value="1">S Parameters</option>
                            <option value="2">Z Parameters</option>
                            <option value="3">Y Parameters</option>
                            <option value="4">ABCD(T) Parameters</option>
                        </select>
                        <select name="network" id="network" class="form-select form-select-lg mb-3" aria-label=".form-select-lg ">
                            <option value="0">Select Type Network</option>
                            <option value="1">T Network</option>
                            <option value="2">&pi; Network</option>
                        </select>
                        <div id="general">
                            <div class="input-group input-group-lg mt-1" id="general_input1">
                                <span class="input-group-text" id="inputGroup-sizing-lg">R1</span>
                                <input placeholder="กรอกค่า R1" name="R1" type="number" class="form-control" aria-label="Sizing input" aria-describedby="inputGroup-sizing-lg">
                                <span class="input-group-text" id="inputGroup-sizing-lg">&#8486;</span>
                            </div>
                            <div class="input-group input-group-lg mt-1" id="general_input2">
                                <span class="input-group-text" id="inputGroup-sizing-lg">R2</span>
                                <input placeholder="กรอกค่า R2" name="R2" type="number" class="form-control" aria-label="Sizing input" aria-describedby="inputGroup-sizing-lg">
                                <span class="input-group-text" id="inputGroup-sizing-lg">&#8486;</span>
                            </div>
                            <div class="input-group input-group-lg mt-1" id="general_input3">
                                <span class="input-group-text" id="inputGroup-sizing-lg">R3</span>
                                <input placeholder="กรอกค่า R3" name="R3" type="number" class="form-control" aria-label="Sizing input" aria-describedby="inputGroup-sizing-lg">
                                <span class="input-group-text" id="inputGroup-sizing-lg">&#8486;</span>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-sm-center">
                            <button type="button" id="cal-btn" class="btn btn-primary col-md-5 my-3 mx-1">Calculate</button>
                            <button type="button" id="reset-btn" class="btn btn-danger col-md-5 my-3 mx-1">reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="imgResult d-flex flex-row justify-content-sm-center align-items-center col-md-6 mt-2">
                <div class="spinner-border text-success" style="width: 10vh; height: 10vh;" role="status">
                    <span class="visually-hidden">Loading..</span>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-sm-center mt-2" id="result">
            <div class="alert alert-warning mt-1" role="alert">
                <h5 class="d-flex flex-row justify-content-sm-center align-items-center">กรอกค่าเพื่อแสดงผลลัพธ์</h5>
            </div>
        </div>

    </div>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $('#general').hide();
    $('#cal-btn').click(function(e) {
        var data = $("#form-cal").serialize();
        $("#cal-btn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
        console.log(data);
        $.ajax({
            data: data,
            type: "GET",
            url: "./display.php",
            success: function(dataResult) {
                if (dataResult) {
                    $("#result").html(dataResult);
                    $("#cal-btn").html('Calculate');
                } else {
                    $("#result").html("<div>คำนวณผิดพลาด</div>");
                    $("#cal-btn").html('Calculate');
                }
            }
        });
    })
    $('#reset-btn').click(function(e) {
        Swal.fire({
            title: 'คุณแน่ใจนะ',
            text: "คุณต้องการเคลียร์ข้อมูลจริงหรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                $("#general").hide();
                $('input').val('');
                $('select').val('0');
                $(".imgResult").html('<div class="spinner-border text-success" style="width: 10vh; height: 10vh;" role="status"><span class="visually-hidden">Loading..</span></div>');
                $("#result").html('<div class="alert alert-warning mt-1" role="alert"><h5 class="d-flex flex-row justify-content-sm-center align-items-center">กรอกค่าเพื่อแสดงผลลัพธ์</h5></div>');
            }
        })

    })
    $('select').change(function(e) {
        var str = "";
        $("select option:selected").each(function() {
            str += $(this).text() + " ";
        });
        console.log(str);
        if (str == "Z Parameters T Network " || str == "Y Parameters T Network " || str == "ABCD(T) Parameters T Network ") {
            $(".imgResult").html('<img src="./img/T-section.png" alt="T-section" class="rounded mx-auto d-block"s style="max-width: 50vh;">');
            $("#general").show();
        } else if (str == "Z Parameters π Network " || str == "Y Parameters π Network " || str == "ABCD(T) Parameters π Network ") {
            $(".imgResult").html('<img src="./img/Pi-section.png" alt="Pi-section" class="rounded mx-auto d-block" style="max-width: 50vh;">');
            $("#general").show();
        } else {
            $("#general").hide();
            $('input').val('');
            $(".imgResult").html('<div class="alert alert-warning mt-1" role="alert"><h5 class="d-flex flex-row justify-content-sm-center align-items-center">เลือก Parameters และ Type Network</h5></div>');
        }
    })
</script>