function check_delete(num) {
  var result=confirm("삭제하시겠습니까?\n Either OK or Cancel.");
  if(result){
        window.location.href='./dml_free.php?mode=delete&num='+num;
  }
}



function check_id() {
  window.open("check_id.php?mode=id_check&id="+document.member_form.id.value,
    "IDcheck",
    "left=10,top=10,width=200,height=60,scrollbars=no,resizable=yes");
}

function check_nick_modify() {
  window.open("modify.php?mode=nick_check&nick="+ document.member_form.nick.value,
    "NICKcheck",
    "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
}

function check_nick() {
  window.open("check_id.php?mode=nick_check&nick="+ document.member_form.nick.value,
    "NICKcheck",
    "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
}

function check_input() {
  if (!document.member_form.id.value) {
    alert("아이디를 입력하세요");
    document.member_form.id.focus();
    return;
  }

  if (!document.member_form.pass.value) {
    alert("비밀번호를 입력하세요");
    document.member_form.pass.focus();
    return;
  }

  if (!document.member_form.pass_confirm.value) {
    alert("비밀번호확인을 입력하세요");
    document.member_form.pass_confirm.focus();
    return;
  }

  if (!document.member_form.name.value) {
    alert("이름을 입력하세요");
    document.member_form.name.focus();
    return;
  }

  if (!document.member_form.nick.value) {
    alert("닉네임을 입력하세요");
    document.member_form.nick.focus();
    return;
  }


  if (!document.member_form.hp2.value || !document.member_form.hp3.value) {
    alert("휴대폰 번호를 입력하세요");
    document.member_form.nick.focus();
    return;
  }

  if (document.member_form.pass.value !=
    document.member_form.pass_confirm.value) {
    alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
    document.member_form.pass.focus();
    document.member_form.pass.select();
    return;
  }

  document.member_form.submit();
}

function reset_form() {
  document.member_form.id.value = "";
  document.member_form.pass.value = "";
  document.member_form.pass_confirm.value = "";
  document.member_form.name.value = "";
  document.member_form.nick.value = "";
  document.member_form.hp1.value = "010";
  document.member_form.hp2.value = "";
  document.member_form.hp3.value = "";
  document.member_form.email1.value = "";
  document.member_form.email2.value = "";

  document.member_form.id.focus();

  return;
}
