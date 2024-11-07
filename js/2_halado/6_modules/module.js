// module.js
let var1 = 'Hello World!';
function func1(item, data) {
    item.innerText = data;
}

export {var1, func1};

// module.js
export default {
    variable: 'Welcome!',
    function: (item, data) => {
        item.innerText = data;
    }
}

