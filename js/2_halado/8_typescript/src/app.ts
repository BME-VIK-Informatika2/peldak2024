let a = 5
// a = 'hello'
// Error: Type 'string' is not assignable to type 'number'

// Statikus típus
let b: number = 5
// Dinamikus típus
let c: any = 5
// Cast-olás
let d: number = <number>c

// Összetett típus
interface Point {
    x: number
    y: number
}

let obj: Point = {
    x: 10,
    y: 20
}

// Paraméterek és visszatérési érték típusa
function sum(a: number, b: number): number {
    return a + b;
}

// Unió típus
function greet(name : string | string[]) : void {
    if(Array.isArray(name)) {
        name.forEach(n => console.log(`Hello ${n}`))
    }
    else {
        console.log(`Hello ${name}`)
    }
}

abstract class Animal {
    public get name(): string {
        return this._name
    }

    abstract makeSound(): void

    static allAnimals: Animal[] = []

    protected constructor(private readonly _name: string) {
        Animal.allAnimals.push(this)
    }
    move() {
        console.log('Moving ...')
    }
}

class Dog extends Animal {
    protected bones: number = 0
    constructor(name: string, public kind: string) {
        super(name);
        this.bones++;
    }
    makeSound() {
        console.log('Woof')
    }

    get bonesCount():number {
        return this.bones;
    }

    set bonesCount(newBones: number) {
        this.bones = newBones;
    }
}

let dog = new Dog('Bodri', 'puli');

console.log(dog.kind); // puli

dog.makeSound(); // Woof
dog.move(); // Moving ...

dog.bonesCount = 10;
console.log(dog.bonesCount); // 10

console.log(Dog.allAnimals.length); // 1


