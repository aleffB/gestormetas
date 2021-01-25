<?php 
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['orgaoSelect'];
$ano = $_POST['anoSelect'];

//consulta janeiro
if($valor == "Janeiro"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metames,toleranciameta, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS m ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);

}

//consulta fevereiro
if($valor == "Fevereiro"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesfev,toleranciametafev, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}

//consulta março
if($valor == "Marco"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesmar,toleranciametamar, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}
//consulta abril
if($valor == "Abril"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesabr,toleranciametaabr, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}

//consulta maio
if($valor == "Maio"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesmai,toleranciametamai, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}

//consulta junho
if($valor == "Junho"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesjun,toleranciametajun, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}
//consulta julho
if($valor == "Julho"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesjul,toleranciametajul, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}
//consulta agosto
if($valor == "Agosto"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesago,toleranciametaago, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}
//consulta setembro
if($valor == "Setembro"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesset,toleranciametaset, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}
//consulta outubro
if($valor == "Outubro"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesout,toleranciametaout, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}
//consulta novembro
if($valor == "Novembro"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesnov,toleranciametanov, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}
//consulta dezembro
if($valor == "Dezembro"){
$sql_code = "SELECT desc_inddep, melhor_traj,und_med, peso,meta_fx1 AS metaano, meta_fx1, meta_fx2, mes_ref, metamesdez,toleranciametadez, result_acum FROM indicadororgao AS io INNER JOIN indicadordepartamental AS ip ON io.id_inddep = ip.id_inddep INNER JOIN resultmensal AS r ON r.id_inddep = ip.id_inddep INNER JOIN metamensal AS M ON m.id_inddep = ip.id_inddep WHERE io.cod_orgao = '$orgao' AND r.mes_ref = '$valor' AND r.anob = '$ano'";



$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
}

?>


