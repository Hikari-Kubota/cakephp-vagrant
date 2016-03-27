/*Global parameters*/
var selected_id;
var selected_name;
var current_page;
function edit(id, name, page){
	/* Set parameters */
	selected_id = id;
	selected_name = name;
	current_page = page;
	var arrow_size_width = 50;
	var arrow_size_height = 20;
	var edit_box_height = 60;

	/* Display edit box. */
	var edit_box = document.getElementById("edit_box");
	edit_box.style.left = event.pageX+arrow_size_width+"px";
	edit_box.style.top = event.pageY-edit_box_height/2+"px";
	edit_box.style.display = "block";

	var arrow = document.getElementById("edit_box_arrow");
	arrow.style.left = event.pageX+"px";
	arrow.style.top = event.pageY-arrow_size_height+"px";
	arrow.style.display = "block";

	console.log(current_page);
	console.log("called!");

}

function btn_update(){
	var data = {"mode":M_FILLFORM, "id":selected_id, "page":current_page};
	post("index.php", data);
}

function btn_delete(){
	if(window.confirm("ID:"+selected_id+" "+selected_name+"さんのデータを削除しますか？")){
		var data = {"mode":M_DELETE, "id":selected_id, "page":current_page};
		post("index.php", data);
	}else{
		btn_cancel();
	}
}

function btn_cancel(){
	var edit_box = document.getElementById("edit_box");
	edit_box.style.display = "none";
	var arrow = document.getElementById("edit_box_arrow");
	arrow.style.display = "None";
}

function post(action, data){
	var form = document.createElement("form");
	form.setAttribute("action", action);
	form.setAttribute("method", "post");
	form.style.display = "none";
	document.body.appendChild(form);

	for (var name in data) {
   		var input = document.createElement('input');
	    input.setAttribute('type', 'hidden');
	    input.setAttribute('name', name);
	    input.setAttribute('value', data[name]);
	    form.appendChild(input);
	}

	form.submit();
}

function fill_form(form_info){
	document.getElementById("i_id").value = form_info["id"];
	document.getElementById("i_last_name").value = form_info["last_name"];
	document.getElementById("i_last_name_kana").value = form_info["last_name_kana"];
	document.getElementById("i_first_name").value = form_info["first_name"];
	document.getElementById("i_first_name_kana").value = form_info["first_name_kana"];
	document.getElementById("i_post1").value = form_info["post1"];
	document.getElementById("i_post2").value = form_info["post2"];
	document.getElementById("i_address").value = form_info["address"];

}




