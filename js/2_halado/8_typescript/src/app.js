var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var a = 5;
// a = 'hello'
// Error: Type 'string' is not assignable to type 'number'
// Statikus típus
var b = 5;
// Dinamikus típus
var c = 5;
// Cast-olás
var d = c;
var obj = {
    x: 10,
    y: 20
};
// Paraméterek és visszatérési érték típusa
function sum(a, b) {
    return a + b;
}
// Unió típus
function greet(name) {
    if (Array.isArray(name)) {
        name.forEach(function (n) { return console.log("Hello ".concat(n)); });
    }
    else {
        console.log("Hello ".concat(name));
    }
}
var Animal = /** @class */ (function () {
    function Animal(_name) {
        this._name = _name;
        Animal.allAnimals.push(this);
    }
    Object.defineProperty(Animal.prototype, "name", {
        get: function () {
            return this._name;
        },
        enumerable: false,
        configurable: true
    });
    Animal.prototype.move = function () {
        console.log('Moving ...');
    };
    Animal.allAnimals = [];
    return Animal;
}());
var Dog = /** @class */ (function (_super) {
    __extends(Dog, _super);
    function Dog(name, kind) {
        var _this = _super.call(this, name) || this;
        _this.kind = kind;
        _this.bones = 0;
        _this.bones++;
        return _this;
    }
    Dog.prototype.makeSound = function () {
        console.log('Woof');
    };
    Object.defineProperty(Dog.prototype, "bonesCount", {
        get: function () {
            return this.bones;
        },
        set: function (newBones) {
            this.bones = newBones;
        },
        enumerable: false,
        configurable: true
    });
    return Dog;
}(Animal));
var dog = new Dog('Bodri', 'puli');
dog.bonesCount = 10;
console.log(dog.bonesCount); // 1
console.log(dog.kind); // puli
