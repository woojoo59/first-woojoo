document.addEventListener('DOMContentLoaded', () => {
    const id = document.querySelector('#identify')
    const pw = document.querySelector('#password')
    const btn = document.querySelector('#login_btn')
    const btn_logout = document.querySelector('#logout_btn')
    if (btn == null){
    btn_logout.addEventListener('click', (e)=>{
        self.location.href='logout.php';
    })} else {
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        
        if(id.value == ''){
            alert('아이디를 입력해주세요')
            id.focus()
            return false
        }
        if(pw.value == ''){
            alert('비밀번호를 입력해주세요')
            pw.focus()
            return false
        }

        document.login_form.submit()
    })}
})