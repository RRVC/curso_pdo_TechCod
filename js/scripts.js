function set_rng() {
    let inputted_name = document.getElementById("name_input");
    let inputted_tel = document.getElementById("tel_input");
    let inputted_email = document.getElementById("email_input");
    //let inputted_birth = document.getElementById("birth_input");
    let inputted_grade = document.getElementById("grade_input");

    let name;
    let surname;


    function rng_name() {
        let name_list = [
            ["Miguel", "Arthur", "Heitor", "Helena", "Alice", "Theo", "Davi", "Laura", "Gabriel", "Gael", "Valentina", "João Miguel"],
            ["Silva", "Santos", "Oliveira", "Souza", "Rodrigues", "Ferreira", "Alves", "Pereira", "Lima", "Gomes", "Ribeiro", "Martins"]
        ];
        let rng1 = Math.floor(Math.random() * 12);
        let rng2 = Math.floor(Math.random() * 12);
        name = name_list[0][rng1];
        surname = name_list[1][rng2];
        return `${name_list[0][rng1]} ${name_list[1][rng2]}`;

    };

    function rng_phone() {
        let rng_number = '9 9';
        for (var c = 0; c < 7; c++) {
            rng_number += Math.floor(Math.random() * 9);
        };
        return rng_number;
    };

    function rng_email() {
        let email_list = [
            "@gmail.com", "@hotmail.com", "@yahoo.com", "@email.com", "@terra.com.br", "@outlook.com", "@uol.com.br", "@msn.com"
        ];
        let rng = Math.floor(Math.random() * 8);
        return `${name}_${surname}${email_list[rng]}`;
    }

    /*
    function rng_birth() {
        let rng_date = new Date((new Date()) - Math.floor(Math.random() * 1639520144665));
        function hasZero(value) {
            result = value < 10 ? "0" + value : value;
            return result;
        };
        let rng_birth = `${rng_date.getFullYear()}-${hasZero(rng_date.getMonth() + 1)}-${hasZero(rng_date.getDate())}`;
        return rng_birth;
    };
    */
    inputted_name.value = rng_name();
    inputted_tel.value = rng_phone();
    inputted_email.value = rng_email();
    //inputted_birth.value = rng_birth();
    inputted_grade.value = (1 + Math.random() * (10 - 1)).toFixed(1);
};