<h2> Liste des produits </h2>

<section class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Produit</th>
                            <th>Désignation </th>
                            <th>Prix</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
            <tbody>
    <?php
      foreach ($lesProduits as $unProduit) {
        echo "<tr> <td>".$unProduit['id_produit']."</td>
              <td>".$unProduit['designation']."</td>
              <td>".$unProduit['prix']."</td>
              <td> 
              <form method='post'>
                <input type='hidden' name='id_produit'
                value='".$unProduit['id_produit']."'>
                <input type='submit' name='Ajouter' value='Ajouter au panier'>
              </form>
              </td>
            </tr>
            "; 
      }
    ?>
  </tbody>
  </table>
  </div>
    </div>
 </section>