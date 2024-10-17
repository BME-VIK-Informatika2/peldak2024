<?php
require '../helpers.php';
/*
 * Konstansok
 */

// define utasítás
define("def_NAME", "Info2");
println(def_NAME); // Info2
define("def_year", 2024);
println(def_year); // 2024
define("def_Subjects", ["SQL", "HTML", "PHP"]);
println(def_Subjects[0]); // SQL

// const kulcsszó
const const_NAME = "Info2";
println(const_NAME); // Info2
const const_year = 2024;
println(const_year); // 2024
const const_Subjects = ["SQL", "HTML", "PHP"];
println(const_Subjects[0]); // SQL

// Magic konstansok
println(__DIR__); // ../php/0_alapok
println(__FILE__); // ../php/0_alapok/1_valtozok.php
println(__LINE__); // 25















