function toggleModify(id){
    let currentmodify = document.getElementById(`todo_form_modify${id}`);
    currentmodify.style.display = currentmodify.style.display=='none' ? 'flex' : 'none';
}
function hideModify(id){
    document.getElementById(`todo_form_modify${id}`).style.display='none';
}
function update(id){
    document.getElementById(`check${id}`).submit();
}