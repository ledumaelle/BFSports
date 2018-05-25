<!DOCTYPE html>
<html>
        <head>
                <title> Panier </title>
                <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <script type="text/javascript" src="<?php echo js_url('test') ?>"></script>
        <body>
        <div class="container-fluid">
        <h2 class="text-success"> <?php echo $TitreDeLaPage ?> </h2><br/>
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10">
                <?php echo form_open('visiteur/afficherPanier'); ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Libellé</th>
                                        <th>Prix unitaire</th>
                                        <th>Montant</th>
                                </tr>
                            </thead>


<?php $i = 1; ?> 

<?php foreach ($this->cart->contents() as $items): ?>

        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

        <tr>
                <td class="col-sm-2"><img  width="50%" src="<?php echo img_url($items['option']) ?>"/></td>
                <td class="col-sm-2">
                <a href="<?php echo site_url('visiteur/diminuerQuantite/'.$items['rowid'].'/'.$items['qty']) ?>" class="btn btn-primary " name="btnDiminuerQuantite"><span class = "glyphicon glyphicon-minus"></span></a>
                <?php echo form_input(array('readonly'=>'readonly','name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '3')); ?>
                <a href="<?php echo site_url('visiteur/augmenterQuantite/'.$items['rowid'].'/'.$items['qty']) ?>" class="btn btn-primary" name="btnAugmenterQuantite"><span class = "glyphicon glyphicon-plus"></span></a>
               </td>
                <td class="col-sm-2"><?php echo $items['name']; ?> </td>
                <td class="col-sm-2"><?php echo $this->cart->format_number($items['price']); ?>€</td>
                <td class="col-sm-2"><?php echo $this->cart->format_number($items['subtotal']); ?>€</td>
        </tr>

<?php $i++; ?>

<?php endforeach; ?>

<tr>
        <td colspan="2"> </td>
        <td class="right"><strong class="text-primary">Total</strong></td>
        <td class="right"><?php echo $this->cart->format_number($this->cart->total()); ?>€</td>
</tr>

</table>
<a href=" <?php echo site_url('visiteur/validerPanier') ?>" type="submit" name="btnValiderPanier" class="btn btn-success"  onClick="return ConfirmerMessage()">Valider votre panier</a>
<script type="text/javascript">
   function ConfirmerMessage()
{
    var r = confirm ("Voulez-vous vraiment continuer ?");
    if (r==true)
        {return true;}
    else 
        {return false;}

}        
</script>

<?php echo '<p></br>'.anchor('visiteur/afficherBoutique','Retour à la liste des produits').'</p>'; ?>
        </body>
        

</html>