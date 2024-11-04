// Változók láthatósága
function varScoping() {
    var x = 1;

    if (true) {
        var x = 2;
        console.log(x); // 2
    }

    console.log(x); // 2
}

function letScoping() {
    let x = 1;

    if (true) {
        let x = 2;
        console.log(x); // 2
    }

    console.log(x); // 1
}

varScoping()
letScoping()


// Változók típusai
// Primitív típusok
var szoveg = 'Gipsz Jakab';
var szoveg2 = "Gipsz Jakab";
var szam = 10;
var logikai = true;
var ures = null;
var nincs = undefined;
var symbol = Symbol();

// Összetett típusok
var objektum = {
    nev: 'Gipsz Jakab',
    kor: 30,
    hazas: false,
}

// Implicit típuskonverzió
var a = 3;
var b = 2;
console.log(a + b); // 5 (Number)

var first = 'Gipsz ';
var last = 'Jakab';
console.log(first + last); // Gipsz Jakab (String)

var ev = 2016;
var honap = 'január';
console.log(ev + honap); // '2016január'
console.log(ev + honap + 1); // '2016január1'
console.log(ev + 1 + honap); // '2017január'

// Öszehasonlítás
var ev = 2016;
if (ev == '2016') { // Ez igaz
    console.log("2016 == '2016' igaz")
}
if (ev === '2016') { // Ez nem igaz
    console.log("2016 === '2016' igaz")
} else {
    console.log("2016 === '2016' hamis")
}

// Undefined és null
var nap;
console.log(nap); // undefined
if (nap === undefined) {
    console.log('Változó értéke: undefined');
}
if (typeof nap === 'undefined') {
    console.log('Változó típusa: undefined');
}

var ures = null;
console.log(ures); // null
if (ures === null) {
    console.log('Változó értéke: null');
}
if (typeof ures === 'object') {
    console.log('Változó típusa: object');
}

// Bool átalakítás
var b = !!'valami';
console.log(typeof b);	// boolean
console.log(b);		// true

// Truthy és Falsy értékek
console.log(!!'0');		// true
console.log(!!0);		// false

if ('0' == 0) {	// true
    console.log("Igaz")
}

// Tömbök
var napok = ['hétfő', 'kedd', 'szerda'];
var evszakok = new Array('tavasz', 'nyár', 'ősz', 'tél');

console.log(typeof napok); // 'object'
console.log(typeof evszakok); // 'object’
for (let i = 0; i < napok.length; i++) {
    console.log(napok[i]); // hétfő, kedd, szerda
}

napok.push('csütörtök');
napok.push('péntek');

var utolso = napok.pop();
console.log(utolso); // péntek
console.log(napok); // hétfő, kedd, szerda, csütörtök

var het_eleje = napok.splice(0, 3, "péntek", "szombat");
console.log(het_eleje); // hétfő, kedd, szerda
console.log(napok); // csütörtök, péntek, szombat

for (let idx in napok) {
    console.log(napok[idx]); // csütörtök, péntek, szombat
}

for (let nap of napok) {
    console.log(nap); // csütörtök, péntek, szombat
}

// Függvények
function osszead(a, b) {
    return a + b;
}

function szoroz(a, b, c = 1) {
    return a * b * c;
}

function alkalmaz(tomb, fuggveny) {
    for (let elem of tomb) {
        fuggveny(elem);
    }
}

function kiir(szoveg) {
    console.log(szoveg);
}

console.log(typeof kiir); // function

alkalmaz(napok, kiir);
// csütörtök, péntek, szombat

alkalmaz(napok, (str) => console.log(str));
// csütörtök, péntek, szombat

// Objektumok
const person = {
    firstName: "John",
    lastName: "Doe",
    age: 50,
};

console.log(person.firstName); // John

const person2 = new Object();
person2.firstName = "Jane";
console.log(person2['firstName']); // Jane

const person3 = {
    firstName: "John",
    lastName: "Doe",
    age: 50,
    fullName: function() {
        return this.firstName + " " + this.lastName;
    }
};

console.log(person3.fullName()); // John Doe
person3.incrementAge = function() {
    this.age++;
}

function Person(firstName, lastName, age) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.age = age;
}

const person4 = new Person("John", "Doe", 50);

var keys = Object.keys(person4);
console.log(keys); // [ 'firstName', 'lastName', 'age' ]

var values = Object.values(person4);
console.log(values); // [ 'John', 'Doe', 50 ]

var entries = Object.entries(person4);
console.log(entries);
// [ [ 'firstName', 'John' ], [ 'lastName', 'Doe' ], [ 'age', 50 ] ]

for(let [key, value] of entries) {
    console.log(key + ": " + value);
}

// Osztályok
class Car {
    constructor(brand) {
        this.carname = brand;
    }
    present() {
        return 'I have a ' + this.carname;
    }
}

var car = new Car("Ford");
console.log(car.present()); // I have a Ford

console.log(typeof Car); // function
console.log(typeof car); // object

class SportCar extends Car {
    constructor(brand, model) {
        super(brand);
        this.model = model;
    }

    get modelName() {
        return this.model;
    }

    set modelName(value) {
        this.model = value;
    }

    static start() {
        return 'Car is started';
    }
}

var sportCar = new SportCar("Ford", "Mustang");
console.log(sportCar.present()); // I have a Ford

sportCar.modelName = "Focus";
console.log(sportCar.modelName); // Focus

console.log(SportCar.start()); // Car is started