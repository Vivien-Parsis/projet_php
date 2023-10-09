function toggleModify(id){
    let currentmodify = document.getElementById(`todo_form_modify${id}`);
    if(currentmodify.style.display=='none'){
        currentmodify.style.display='flex';
        return;
    }
    if(currentmodify.style.display=='flex'){
        currentmodify.style.display='none';
        return;
    }
}
function hideModify(id){
    document.getElementById(`todo_form_modify${id}`).style.display='none';
}
function update(id){
    document.getElementById(`check${id}`).submit();
}