function input_member() {
    let count = document.querySelectorAll("input[type=text]");
    let new_count = count.length+1;
    
    document.getElementById('inp_qlty_num').value = new_count;

    let x = document.createElement("input");
    x.setAttribute("type", "text");
    x.setAttribute("id", "inp");
    x.setAttribute("placeholder", "Nhập tên");
    x.setAttribute("name", "inp_name[]");
    x.setAttribute('required', '');
    x.classList.add('form-control-inpm');
    x.classList.add('mb-3');
    document.getElementById('member').appendChild(x);

    let z = document.createElement("br");
    document.getElementById('member').appendChild(z);
}
function input_chi() {
    let count = document.querySelectorAll("input[type=text]");
    let new_count = count.length+1;
    
    document.getElementById('inp_qlty_num').value = new_count;

    let x = document.createElement("input");
    x.setAttribute("type", "text");
    x.setAttribute("id", "inp");
    x.setAttribute("placeholder", "Nhập tên");
    x.setAttribute("name", "inp_name[]");
    x.setAttribute('required', '');
    x.classList.add('form-control-inpm');
    x.classList.add('mb-3');
    document.getElementById('member_chi').appendChild(x);

    let y = document.createElement("input");
    y.setAttribute("type", "number");
    y.setAttribute("id", "price");
    y.setAttribute("placeholder", "Nhập số tiền chi");
    y.setAttribute("name", "inp_price[]");
    y.setAttribute("onblur", "findTotal()");
    y.setAttribute('required', '');
    y.classList.add('form-control-inpm');
    y.classList.add('ms-3');
    document.getElementById('member_chi').appendChild(y);

    let z = document.createElement("br");
    document.getElementById('member_chi').appendChild(z);
}