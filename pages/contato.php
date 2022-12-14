<div id="map" style="width:100%;height:400px;"></div>
<div class="contato-container">
    <div class="center">
        <form class="ajax-form" method="post" action="">
            <input required type="text" name="nome" placeholder="Nome...">
            <div></div>
            <input required type="text" name="email" placeholder="E-mail...">
            <div></div>
            <input required type="text" name="telefone" placeholder="Telefone...">
            <div></div>
            <textarea name="mensagem" placeholder="Sua mensagem..."></textarea>
            <div></div>
            <input type="hidden" name="identificador" value="form_contato" />
            <input type="submit" name="acao" value="Enviar">
        </form>
    </div>
</div>

<style rel="stylesheet">
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

.center{
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 2%;
}

.contato-container{
    padding: 40px 0;
    text-align: center;
}  

.contato-container input[type=text]{
    max-width: 800px;
    width: 100%;
    height: 40px;
    font-size: 16px;
    color: #444;
    padding-left: 8px;
    border: 1px solid #ccc;
    margin: 8px 0;
}  

.contato-container textarea{
    max-width: 800px;
    width: 100%;
    height: 120px;
    font-size: 16px;
    color: #444;
    padding: 8px;
    border: 1px solid #ccc;
    margin: 8px 0;
    resize: vertical;
}

.contato-container input[type=submit]{
    width: 140px;
    height: 40px;
    background-color: #00c59e;
    color: white;
    cursor: pointer;
    border: 0;
} 
</style>