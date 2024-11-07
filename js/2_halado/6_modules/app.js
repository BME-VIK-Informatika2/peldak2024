// app.js
import {var1, func1} from './module.js';

let p1 = document.querySelector('#p1')
func1(p1, var1);

// app.js
import module from './module.js';
let p2 = document.querySelector('#p2')
module.function(p2, module.variable);
