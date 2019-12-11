<h1>Serviços</h1>

<div style="clear:both"></div>
<div style="text-align:center">
<?php if($edit_permission): ?>

    
    <div class="button"  ><a href="<?php echo BASE_URL;?>/services/add">Novo Serviço</a></div>
<?php endif; ?>
</div>
<!-- <input type="text" id="busca" data-type="search_clients_service" /> -->

</br></br>

        <table border="1" width="100%">
            <tr>
                    <th>Data</th>
                    <th>Veiculo</th>
                    <th>Serviço</th>
                    <th>Ações</th>
            </tr>
                    <?php foreach ($services_list as $c): ?>
                    <tr>
                        <td width="100"><?php echo $c['date_service']; ?></td>
                        <td width="100" style="text-align:center"><?php echo $c['veiculo'];
                         ?></td>
                         <td style="text-align:center"><?php echo $c['servico'];
                         ?></td>

                        <td width="200" style="text-align:center">
                            
                                    <div class="button button_small" style="background-color:#1E90FF"><a href="<?php echo BASE_URL; ?>/services/edit/<?php echo $c['id']; ?>">Editar</a></div>


                    
                    

                        </td>
                    </tr>
                    <?php endforeach; ?>
               

            </table>

         <div class="pagination" >
        <?php for($q=1; $q<=$p_count;$q++): ?>
        <div class="pag_item <?php echo($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/services?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>


    <?php endfor; ?>

    <div style="clear:both"></div>
</div>

