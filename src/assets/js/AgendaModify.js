function toggleModify(id){
    let currentmodify = document.getElementById(`agenda_form_modify${id}`);
    currentmodify.style.display = currentmodify.style.display=='none' ? 'flex' : 'none';
}
function hideModify(id){
    document.getElementById(`agenda_form_modify${id}`).style.display='none';
}