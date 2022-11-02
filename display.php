<style>
    .cal_matrix_box {
        position: relative;
        display: inline-block;
        padding: 2px 5px;
        border-width: 0 2px 0 2px;
        border-style: solid;
        border-color: #000;
        vertical-align: middle;
    }

    .cal_matrix_box .xtl {
        left: 0;
        top: 0;
    }

    .cal_matrix_box .xtr {
        right: 0;
        top: 0;
    }

    .cal_matrix_box .xbr {
        right: 0;
        bottom: 0;
    }

    .cal_matrix_box .xbl {
        left: 0;
        bottom: 0;
    }

    .cal_matrix_box .xcb {
        position: absolute;
        display: block;
        width: 5px;
        height: 2px;
        background-color: #000;
    }

    td {
        font-size: 2vh;
    }
</style>
<?php
$R1 = (float)$_GET['R1'];
$R2 = (float)$_GET['R2'];
$R3 = (float)$_GET['R3'];
$typeParameter = $_GET['parameter'];
$typeNetwork = $_GET['network'];
switch ($typeParameter) {
    case "1":
        $typeParameter = "S Parameters";
        break;
    case "2":
        $typeParameter = "Z Parameters";
        break;
    case "3":
        $typeParameter = "Y Parameters";
        break;
    case "4":
        $typeParameter = "ABCD(T) Parameters";
        break;
    default:
        $typeParameter = "ค่าว่าง";
}
switch ($typeNetwork) {
    case "1":
        $typeNetwork = "T Network";
        break;
    case "2":
        $typeNetwork = "&pi; Network";
        break;
    default:
        $typeNetwork = "ค่าว่าง";
}

if ($typeParameter == "ค่าว่าง" || $typeNetwork == "ค่าว่าง") {
    echo '<div class="alert alert-danger mt-1" role="alert">
                <h5>กรุณาเลือกประเภท</h5>
            </div>';
} else {
    if ($R1 > 0 && $R2 > 0 && $R3 > 0) {
        echo '<div class="row d-flex flex-row justify-content-sm-center align-items-center">
                <div class="alert alert-primary mt-1 col-md-5 me-1" role="alert">
                    <h5>Parameter : ' . $typeParameter . '</h5>
                    <h5>Network : ' . $typeNetwork . '</h5>
                    <h5>R1 : ' . $R1 . ' &#8486;</h5>
                    <h5>R2 : ' . $R2 . ' &#8486;</h5>
                    <h5>R3 : ' . $R3 . ' &#8486;</h5>
                </div>';
        // ABCD(T) Parameters T Network
        if ($typeParameter == "ABCD(T) Parameters" && $typeNetwork == "T Network") {
            $A = 1 + ((1 / (float)$R2) * (float)$R1);
            $B = (float)$R1 + (float)$R3 + ((1 / (float)$R2) * $R1 * $R3);
            $C = 1 / (float)$R2;
            $D = 1 + ((1 / (float)$R2) * (float)$R3);
            echo '<div class="alert alert-primary mt-1 col-md-6" role="alert">
                    <h5><b>สูตร</b></h5>
                    <h5>A = 1+((1/R2)*R1)</h5>
                    <h5>B = R1+R3+((1/R2)*R1*R3)</h5>
                    <h5>C = 1/R2</h5>
                    <h5>D = 1+((1/R2)*R3)</h5>
                </div></div>';
            echo   '<div class="alert alert-success" role="alert">
                        <div class="answer d-flex flex-row justify-content-sm-center align-items-center">
                            <h5>ABCD(T) Parameters = &nbsp</h5>
                            <div class="cal_matrix_box">
                                <div class="xcb xtl"></div>
                                <div class="xcb xtr"></div>
                                <div class="xcb xbl"></div>
                                <div class="xcb xbr"></div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td> A &nbsp</td>
                                            <td> B </td>
                                        </tr>
                                        <tr>
                                            <td> C &nbsp</td>
                                            <td> D </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h5>&nbsp = &nbsp</h5>
                            <div class="cal_matrix_box">
                                <div class="xcb xtl"></div>
                                <div class="xcb xtr"></div>
                                <div class="xcb xbl"></div>
                                <div class="xcb xbr"></div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>' . number_format($A, 2) . '&nbsp</td>
                                            <td>' . number_format($B, 2) . '</td>
                                        </tr>
                                        <tr>
                                            <td>' . number_format($C, 2) . '&nbsp</td>
                                            <td>' . number_format($D, 2) . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
        }
        // ABCD(T) Parameters pi Network
        else if ($typeParameter == "ABCD(T) Parameters" && $typeNetwork == "&pi; Network") {
            $A = 1 + ((1 / (float)$R3) * (float)$R2);
            $B = (float)$R2;
            $C = (1 / (float)$R1) + (1 / (float)$R3) + ((1 / (float)$R1) * (1 / (float)$R3) * (float)$R2);
            $D = 1 + ((1 / (float)$R1) * (float)$R2);
            echo '<div class="alert alert-primary mt-1 col-md-6" role="alert">
                    <h5><b>สูตร</b></h5>
                    <h5>A = 1+((1/R3)*R2)</h5>
                    <h5>B = R2</h5>
                    <h5>C = (1/R1)+(1/R3)+((1/R1)*(1/R3)*R2)</h5>
                    <h5>D = 1+((1/R1)*R2)</h5>
                </div></div>';
            echo '
                <div class="alert alert-success" role="alert">
                    <div class="answer d-flex flex-row justify-content-sm-center align-items-center">
                        <h5>ABCD(T) Parameters = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td> A &nbsp</td>
                                        <td> B </td>
                                    </tr>
                                    <tr>
                                        <td> C &nbsp</td>
                                        <td> D </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>&nbsp = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>' . number_format($A, 2) . '&nbsp</td>
                                        <td>' . number_format($B, 2) . '</td>
                                    </tr>
                                    <tr>
                                        <td>' . number_format($C, 2) . '&nbsp</td>
                                        <td>' . number_format($D, 2) . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';
        }
        // S Parameters T Network ? AOMSIN
        else if ($typeParameter == "S Parameters" && $typeNetwork == "T Network") {
            $S11 = 1 + ((1 / (int)$R3) * (int)$R2);
            $S12 = (int)$R2;
            $S21 = (1 / (int)$R1) + (1 / (int)$R3) + ((1 / (int)$R1) * (1 / (int)$R3) * (int)$R2);
            $S22 = 1 + ((1 / (int)$R1) * (int)$R2);
            echo ' <div class="alert alert-success" role="alert">
                    <div class="answer d-flex flex-row justify-content-sm-center align-items-center">
                        <h5>S Parameters = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td> S11 &nbsp</td>
                                        <td> S12 </td>
                                    </tr>
                                    <tr>
                                        <td> S21 &nbsp</td>
                                        <td> S22 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>&nbsp = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>' . number_format($S11, 2) . '&nbsp</td>
                                        <td>' . number_format($S12, 2) . '</td>
                                    </tr>
                                    <tr>
                                        <td>' . number_format($S21, 2) . '&nbsp</td>
                                        <td>' . number_format($S22, 2) . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';
        }
        // S Parameters pi Network ? AOMSIN
        else if ($typeParameter == "S Parameters" && $typeNetwork == "&pi; Network") {
            $S11 = 1 + ((1 / (int)$R3) * (int)$R2);
            $S12 = (int)$R2;
            $S21 = (1 / (int)$R1) + (1 / (int)$R3) + ((1 / (int)$R1) * (1 / (int)$R3) * (int)$R2);
            $S22 = 1 + ((1 / (int)$R1) * (int)$R2);
            echo ' <div class="alert alert-success" role="alert">
                    <div class="answer d-flex flex-row justify-content-sm-center align-items-center">
                        <h5>S Parameters = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td> S11 &nbsp</td>
                                        <td> S12 </td>
                                    </tr>
                                    <tr>
                                        <td> S21 &nbsp</td>
                                        <td> S22 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>&nbsp = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>' . number_format($S11, 2) . '&nbsp</td>
                                        <td>' . number_format($S12, 2) . '</td>
                                    </tr>
                                    <tr>
                                        <td>' . number_format($S21, 2) . '&nbsp</td>
                                        <td>' . number_format($S22, 2) . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';
        }
        // Z Parameters T Network
        else if ($typeParameter == "Z Parameters" && $typeNetwork == "T Network") {
            $Z11 = $R1 + $R2;
            $Z12 = $R2;
            $Z21 = $R2;
            $Z22 = $R2 + $R3;
            echo '<div class="alert alert-primary mt-1 col-md-6" role="alert">
                    <h5><b>สูตร</b></h5>
                    <h5>Z11 = R1+R2</h5>
                    <h5>Z12 = R2</h5>
                    <h5>Z21 = R2</h5>
                    <h5>Z22 = R3+R2</h5>
                </div></div>';
            echo '
                <div class="alert alert-success" role="alert">
                    <div class="answer d-flex flex-row justify-content-sm-center align-items-center">
                        <h5>Z Parameters = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td> Z11 &nbsp</td>
                                        <td> Z12 </td>
                                    </tr>
                                    <tr>
                                        <td> Z21 &nbsp</td>
                                        <td> Z22 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>&nbsp = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>' . number_format($Z11, 2) . '&nbsp</td>
                                        <td>' . number_format($Z12, 2) . '</td>
                                    </tr>
                                    <tr>
                                        <td>' . number_format($Z21, 2) . '&nbsp</td>
                                        <td>' . number_format($Z22, 2) . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';
        }
        // Z Parameters pi Network
        else if ($typeParameter == "Z Parameters" && $typeNetwork == "&pi; Network") {
            $Z11 = ($R1 * ($R2 + $R3)) / ($R1 + $R2 + $R3);
            $Z12 = ($R1 * $R3) / ($R1 + $R2 + $R3);
            $Z21 = ($R3 * $R1) / ($R1 + $R2 + $R3);
            $Z22 = ($R3 * ($R1 + $R2)) / ($R1 + $R2 + $R3);
            echo '<div class="alert alert-primary mt-1 col-md-6" role="alert">
                    <h5><b>สูตร</b></h5>
                    <h5>Z11 = R1//(R2+R3)</h5>
                    <h5>Z12 = R1//R3</h5>
                    <h5>Z21 = R3//R1</h5>
                    <h5>Z22 = R3//(R1+R2)</h5>
                </div></div>';
            echo '
                <div class="alert alert-success" role="alert">
                    <div class="answer d-flex flex-row justify-content-sm-center align-items-center">
                        <h5>Z Parameters = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td> Z11 &nbsp</td>
                                        <td> Z12 </td>
                                    </tr>
                                    <tr>
                                        <td> Z21 &nbsp</td>
                                        <td> Z22 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>&nbsp = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>' . number_format($Z11, 2) . '&nbsp</td>
                                        <td>' . number_format($Z12, 2) . '</td>
                                    </tr>
                                    <tr>
                                        <td>' . number_format($Z21, 2) . '&nbsp</td>
                                        <td>' . number_format($Z22, 2) . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';
        }
        // Y Parameters T Network ? ARM
        else if ($typeParameter == "Y Parameters" && $typeNetwork == "T Network") {
            $Z1 = $R1 + $R2 + (($R1 + $R2) / $R3);
            $Z2 = $R1 + $R3 + (($R1 + $R3) / $R2);
            $Z3 = $R2 + $R3 + (($R2 + $R3) / $R1);
            $Y11 = $Z1 + $Z2;
            $Y12 = -$Z2;
            $Y21 = -$Z2;
            $Y22 = $Z2 + $Z3;
            echo '<div class="alert alert-primary mt-1 col-md-6" role="alert">
                    <h5><b>สูตร</b></h5>
                    <h5>Z11 = R1//(R2+R3)</h5>
                    <h5>Z12 = R1//R3</h5>
                    <h5>Z21 = R3//R1</h5>
                    <h5>Z22 = R3//(R1+R2)</h5>
                </div></div>';
            echo '
                <div class="alert alert-success" role="alert">
                    <div class="answer d-flex flex-row justify-content-sm-center align-items-center">
                        <h5>Y Parameters = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td> Y11 &nbsp</td>
                                        <td> Y12 </td>
                                    </tr>
                                    <tr>
                                        <td> Y21 &nbsp</td>
                                        <td> Y22 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>&nbsp = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>' . number_format($Y11, 2) . '&nbsp</td>
                                        <td>' . number_format($Y12, 2) . '</td>
                                    </tr>
                                    <tr>
                                        <td>' . number_format($Y21, 2) . '&nbsp</td>
                                        <td>' . number_format($Y22, 2) . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';
        }
        // Y Parameters pi Network ? ARM
        else if ($typeParameter == "Y Parameters" && $typeNetwork == "&pi; Network") {
            $Y11 = $R1 + $R2;
            $Y12 = -$R2;
            $Y21 = -$R2;
            $Y22 = $R2 + $R3;
            echo '<div class="alert alert-primary mt-1 col-md-6" role="alert">
                    <h5><b>สูตร</b></h5>
                    <h5>Y11 = R1 + R2</h5>
                    <h5>Y12 = -R2</h5>
                    <h5>Y21 = -R2</h5>
                    <h5>Y22 = R2 + R3</h5>
                </div></div>';
            echo '
                <div class="alert alert-success" role="alert">
                    <div class="answer d-flex flex-row justify-content-sm-center align-items-center">
                        <h5>Y Parameters = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td> Y11 &nbsp</td>
                                        <td> Y12 </td>
                                    </tr>
                                    <tr>
                                        <td> Y21 &nbsp</td>
                                        <td> Y22 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>&nbsp = &nbsp</h5>
                        <div class="cal_matrix_box">
                            <div class="xcb xtl"></div>
                            <div class="xcb xtr"></div>
                            <div class="xcb xbl"></div>
                            <div class="xcb xbr"></div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>' . number_format($Y11, 2) . '&nbsp</td>
                                        <td>' . number_format($Y12, 2) . '</td>
                                    </tr>
                                    <tr>
                                        <td>' . number_format($Y21, 2) . '&nbsp</td>
                                        <td>' . number_format($Y22, 2) . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';
        }
    } else {
        echo '<div class="alert alert-danger mt-1" role="alert">
                <h5>กรุณากรอกค่าให้ครบ</h5>
            </div>';
    }
}

?>