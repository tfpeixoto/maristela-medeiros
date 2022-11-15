<div class="modal fade" id="SolicitaContato" tabindex="-1" role="dialog" aria-labelledby="SolicitaContato" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Precisa de ajuda, fale comigo!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php echo do_shortcode( '[contact-form-7 id="23" title="Form Contato"]' ); ?>

      <?php /*
      <div class="modal-body">        
        <div class="container">          
          <div class="row">          
            <div class="col">
              <label for="nome">Nome</label>
              <input type="text" id="nome" class="form-control" placeholder="Digite seu nome">
            </div>
            <div class="col">
              <label for="telefone">Telefone</label>
              <input type="text" id="telefone" class="form-control" placeholder="(00) 00000-0000">
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="email">E-mail</label>
              <input type="text" id="email" class="form-control" placeholder="Digite seu e-mail">
            </div>
            <div class="col">
              <label for="empresa">Empresa</label>
              <input type="text" id="empresa" class="form-control" placeholder="Digite o nome da sua empresa">
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="mensagem">Mensagem</label>
              <textarea name="mensagem" class="form-control" placeholder="Descreva como posso te ajudar"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Enviar</button>
      </div>
      */ ?>
    </div>
  </div>
</div>