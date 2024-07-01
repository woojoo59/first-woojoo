document.addEventListener('DOMContentLoaded', ()=> {
    const doc = document.querySelector('#doc')
    const user_id0 = document.querySelector('#user_id0')
    const password0 = document.querySelector('#password0')
    const login_btn = document.querySelector('#login0')
    const formdata = document.querySelector('#login_form0')
    login_btn.addEventListener("click", () =>{
        if(user_id0.value == ''){
            alert('ID를 입력해주세요.')
            user_id0.focus();
            return false
        }
        if(password0.value == ''){
            alert('비밀번호를 입력해주세요.')
            password0.focus();
            return false
        }
        formdata.action='http://localhost/boardproject/login/login.php'
    })

    
})

