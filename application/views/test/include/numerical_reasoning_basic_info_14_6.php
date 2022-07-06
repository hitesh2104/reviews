<?php

$sectionOneArr = array(
    array(
        'qus' => "4 + 8 + 2 – 5 =",
        'option' => array(5, 6, 9, 8),
        'ans' => 9,
    ),
    array(
        'qus' => "8 x 2 – 9 =",
        'option' => array(7, 8, 9, 6),
        'ans' => 7,
    ),
    array(
        'qus' => "10 ÷ 2 x 4 =",
        'option' => array(24, 16, 20, 18),
        'ans' => 20,
    ),
    array(
        'qus' => "18 ÷ 2 x 6 ÷ 3 =",
        'option' => array(56, 18, 22, 54),
        'ans' => 18,
    ),
    array(
        'qus' => "36 ÷ 3 x 4 x 4 ÷ 2 =",
        'option' => array(128, 96, 94, 124),
        'ans' => 96,
    ),
    array(
        'qus' => "2 x ½ x 32 ÷ 8 =",
        'option' => array(4, 6, 8, 2),
        'ans' => 4,
    ),
    array(
        'qus' => "25 ÷ 5 x ½ x 5 =",
        'option' => array(12, 10.5, 12.5, 14),
        'ans' => 12.5,
    ),
    array(
        'qus' => "16 + 16 x 8 ÷ 2 =",
        'option' => array(128, 80, 72, 100),
        'ans' => 80,
    ),
    array(
        'qus' => "15 x 3 ÷ 5 – 14 =",
        'option' => array(-5, 23, 14, -23),
        'ans' => -5,
    ),
    array(
        'qus' => "38 ÷ 2 x 4 – 15 =",
        'option' => array(60, 71, 59, 61),
        'ans' => 61,
    )
);

$sectionTwoArr = array(
    array(
        'qus' => "How many cars were sold in 2015",
        'option' => array(52, 34, 25, 54),
        'ans' => 34,
    ),
    array(
        'qus' => "How many Cycles were sold in 2014",
        'option' => array(19, 34, 52, 22),
        'ans' => 52,
    ),
    array(
        'qus' => "What was sold the most in 2015",
        'option' => array("Cycles", "Cars", "Trains", "Planes"),
        'ans' => "Cycles",
    ),
    array(
        'qus' => "Was there an increase or decrease in Planes sold in 2015",
        'option' => array("Increase", "Decrease", "Cannot say"),
        'ans' => "Increase",
    ),
    array(
        'qus' => "What is the difference in train sales versus motorcycles sales in 2014",
        'option' => array("15", "5", "14", "4"),
        'ans' => 4,
    ),
    array(
        'qus' => "How many cycles and cars were sold in total in 2015",
        'option' => array("88", "79", "56", "72"),
        'ans' => 88,
    ),
    array(
        'qus' => "Which was sold the most in 2014",
        'option' => array("Motorcycles and Cars", "Trains and Boats", "Cycles and Cars", "Boats and Motorcycles"),
        'ans' => "Cycles and Cars",
    ),
    array(
        'qus' => "Which was sold the least in 2015",
        'option' => array("Motorcycles and Cars", "Trains and Boats", "Cycles and Cars", "Boats and Motorcycles"),
        'ans' => "Boats and Motorcycles",
    ),
    array(
        'qus' => "Which was sold the most in both 2014 and 2015 combined",
        'option' => array("Trains and Boats", "Boats and Motorcycles", "Cars and Planes", "Boats and Planes"),
        'ans' => "Cars and Planes",
    ),
    array(
        'qus' => "Which was sold the least in both 2014 and 2015 combined",
        'option' => array("Trains and Boats", "Boats and Motorcycles", "Cars and Planes", "Boats and Planes"),
        'ans' => "Boats and Planes",
    )
);

$sectionThreeArr = array(
    array(
        'qus' => array(1, 2, '?', 5, 8, 13),
        'ans' => 3,
    ),
    array(
        'qus' => array(2, 4, 6, '?', 10, 12),
        'ans' => 8,
    ),
    array(
        'qus' => array(5, 10, 15, 20, 25, '?'),
        'ans' => 30,
    ),
    array(
        'qus' => array(2, 2, 4, '?', 10, 16),
        'ans' => 6,
    ),
    array(
        'qus' => array(5, 10, 20, '?', 80, 160),
        'ans' => 40,
    ),
    array(
        'qus' => array('?', 2, 6, 24, 120, 720),
        'ans' => 1,
    ),
    array(
        'qus' => array(2, 4, 6, 12, '?', 28),
        'ans' => 14,
    ),
    array(
        'qus' => array(6, '?', 12, 4, 18, 6),
        'ans' => 2,
    ),
    array(
        'qus' => array(18, 15, 17, '?', 16, 17),
        'ans' => 16,
    ),
    array(
        'qus' => array(20, 30, 45, '?', 101.25, 151.88),
        'ans' => 67.5,
    ),
);


/**
 * This array is for newly added test which will shown in Section A instead of last section
 * author@ Amit Sahu 
 */
$sectionFourArr = array(
    array(
        'qus' => "How far is Welkom from Colesburg?",
        'option' => array("a" => "446", "b" => "406", "c" => "743", "d" => "243"),
        'ans' => "b",
    ),
    array(
        'qus' => "How far is Worcester from Welkom?",
        'option' => array("a" => 985, "b" => "1182", "c" => "1212", "d" => "1115"),
        'ans' => "d",
    ),
    array(
        'qus' => "If you drive from Bloem to Paarl, then from Paarl to Cape Town, how far have you traveled?",
        'option' => array("a" => "1076", "b" => "1039", "c" => "1140", "d" => "1103"),
        'ans' => "a",
    ),
    array(
        'qus' => "If you travel at a constant 100km/h, how long will it take you to travel from Colesburg to Welkom and back?",
        'option' => array("a" => "8 hours, 7 minutes", "b" => "4 hours, 3 minutes", "c" => "4 hours, 27 minutes", "d" => "8 hours, 55 minutes"),
        'ans' => "d",
    ),
    array(
        'qus' => "If you travel from Cape Town to Bloemfontein, continuing on to Welkom, and then to Kroonstad, how far did you travel?",
        'option' => array("a" => "1293", "b" => "1214", "c" => "1310", "d" => "1231"),
        'ans' => "d",
    ),
    array(
        'qus' => "If you travel a constant speed of 100 km/h, how long will it take you to get from Colesburg to Paarl?",
        'option' => array("a" => "8 hours and 15 minutes", "b" => "7 hours and 22 minutes", "c" => "7 hours and 55 minutes", "d" => "8 hours and 12 minutes"),
        'ans' => "c",
    ),
    array(
        'qus' => "How much further is Bloem to Laingsburg, than Paarl to Cape Town?",
        'option' => array("a" => "762", "b" => "218", "c" => "284", "d" => "998"),
        'ans' => "a",
    ),
    array(
        'qus' => "If you travel a constant speed of 100 km/h from Worcester to Paarl, and then 50 km/h from Paarl to Cape Town, how long will it take?",
        'option' => array("a" => "2 hours and 10 minutes", "b" => "1 hour and 46 minutes", "c" => "1 hour and 24 minutes", "d" => "1 hour and 36 minutes"),
        'ans' => "d",
    ),
    array(
        'qus' => "If you travel from Kroonstad to Colesburg in 3 hours 52 minutes, how fast did you drive",
        'option' => array("a" => "109 km/h", "b" => "119 km/h", "c" => "115 km/h", "d" => "105 km/h"),
        'ans' => "c",
    ),
    array(
          'qus' => "If you travel from Paarl to Worcester, then to Joburg and you traveling at average speed of 100km/h, how long will it take you to get to Joburg?",
        'option' => array("a" => "16 hours, 17 minutes", "b" => "15 hours, 01 minutes", "c" => "15 hours, 47 minutes", "d" => "14 hours, 31 minutes"),
        'ans' => "a",
    ),
);
?>