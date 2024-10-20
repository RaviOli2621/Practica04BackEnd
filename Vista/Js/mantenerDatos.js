function md(usuari, correu)
{
    document.getElementById("usuari").value = usuari;
    document.getElementById("correu").value = correu;
    
}

if(document.getElementById("resposta").value != "noHay")
    {
        let s = document.getElementById("resposta");

        md((s.value + "").split(",")[0],(s.value + "").split(",")[1]);
    } 