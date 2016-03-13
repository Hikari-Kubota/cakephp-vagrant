/*Global parameters*/
var selected_id;


function edit(){
	/* Set parameters */
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
}

function btn_update(){
	var data = {"mode":M_UPDATE, "id":selected_id};
	post("input.php", data);
}

function btn_delete(){
	if(window.confirm("ID:"+selected_id+" のデータを削除しますか？")){
		var data = {"mode":M_DELETE, "id":selected_id};
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







