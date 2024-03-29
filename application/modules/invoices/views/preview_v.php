<?php
// $period       = explode(' - ', $invoice->ba_periode);
$telkom_share = $invoice->ba_amount*($partner->pks_telkom_share/100);
$mitra_share  = $invoice->ba_amount*($partner->pks_mitra_share/100);
$total        = $invoice->ba_amount-$telkom_share;
?>
<div class="box box-primary" style="min-height: 440px">
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
      <h3>INVOICE</h3>
      <br/><br/>
      <div class='row'>
        <div class='col-xs-1'>Nomor</div>
        <div class='col-xs-1'><p class='pull-right'>:</p></div>
        <div class='col-xs-8 col-md-5'><p><?=$invoice->inv_number?></p></div>
      </div>

      <?php /*
      <div class='row'>
        <div class='col-xs-1'>No BA</div>
        <div class='col-xs-1'><p class='pull-right'>:</p></div>
        <div class='col-xs-8 col-md-5'><p style='word-wrap: break-word;'><?=$invoice->ba_number?></p></div>
      </div> */?>

      <div class='row'>
        <div class='col-xs-1'>Perihal</div>
        <div class='col-xs-1'><p class='pull-right'>:</p></div>
        <div class='col-xs-8 col-md-5'>
          <p style='word-wrap: break-word;'><?="Penagihan profit sharing layanan <b>".strtoupper($invoice->name)."</b> periode <b>$periode</b>"?></p>
        </div>
      </div>
    </div>
  </div><br/><br/>
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
      <p>Kepada: </p>
      <p>PT Telekomunikasi Indonesia</p>
      <p>di Jakarta</p>
    </div>
  </div><br/>
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
      <p>Berdasarkan Berita Acara No <?="<b>".$invoice->ba_number."</b>"?> kami sampaikan tagihan 
      utk layanan <?="<b>".strtoupper($invoice->name)."</b>"?> periode <?="<b>".$periode."</b> :"?> </p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-8 col-xs-offset-2">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <th class="text-center">No.</th>
            <th class="text-center">Report No.</th>
            <th class="text-center">Service</th>
            <th class="text-center">Amount</th>
          </thead>
          <tbody>
            <?php
            if($invoice->partner_tax_stat){
              $amount   = $invoice->inv_amount/1.1;
            }else{
              $amount   = $invoice->inv_amount;
            }
            ?>
            <tr>
              <td class="text-center"><?=number_format(1, 0, ',', '.')?></td>
              <td class="text-center"><?=$invoice->inv_number?></td>
              <td class="text-center"><?=strtoupper($invoice->name)?></td>
              <td class="text-right"><?=number_format($amount, 2, ',', '.')?></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center" colspan="3">Sub Total</th>
              <th class="text-right"><?=number_format($amount, 2, ',', '.')?></th>
            </tr>
            <?php
            // $amount   = $invoice->inv_amount;
            $total    = $amount;
            if($invoice->partner_tax_stat){
              $ppn    = $total*(10/100);
              $total += $ppn;
            ?>
            <tr>
              <th class="text-center" colspan="3">PPN: 10% X Sub Total</th>
              <th class="text-right"><?=number_format($ppn, 2, ',', '.')?></th>
            </tr>
            <?php } ?>
            <tr>
              <th class="text-center" colspan="3">Total yang harus dibayarkan</th>
              <th class="text-right"><?=number_format($total, 2, ',', '.')?></th>
            </tr>
            <tr>
              <th class="text-center">Terbilang</th>
              <th class="text-center" colspan="3"><?=$this->convnumber->terbilang($total)." Rupiah."?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div><br/>
  <div class="row">
    <div class="col-xs-6 col-sm-5 col-xs-offset-1">
      <p>Catatan:</p>
      <p class='text-justify'> Pembayaran dapat ditransfer melalui <b>BANK <?=strtoupper($invoice->pbank_name)?>
      </b> No Rekening: <b><?=$invoice->pbank_rekening." A.N. ".strtoupper($invoice->pbank_an)?></b></p>
    </div>
  </div><br/><br/><br/>
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
      <div class='col-xs-6 text-center'></div>

      <div class='col-xs-6 text-center'>
        <p><?=ucwords($invoice->partner_city).", ".$this->convnumber->indonesian_date(strtotime($invoice->inv_created), 'd F Y', '')?><br/>
        <?=ucwords($invoice->partner_name)?></p>
        <br/><br/><br/>
        <u class='text-underline'><?=strtoupper($invoice->first_name." ".$invoice->last_name)?></u>
        <p>Direktur</p>
      </div>
    </div>
  </div><br/><br/><br/><br/>
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
      <p class='text-center'><?=$invoice->partner_address." ".$invoice->partner_city." Telp. ".$invoice->partner_office_phone?></p>
    </div>
  </div><br/>

  <div class="row">
    <div class="col-xs-12"><hr/></div>
  </div>
  <div class="col-xs-12">
    <div class="col-md-2">
      <?php
      if($invoice->partner_tax_stat){
      ?>
      <a target="_blank" href="<?=base_url()."uploads/faktur-pajak-invoice/$invoice->inv_file"?>">Preview Faktur Pajak</a>
      <?php } ?>
    </div>
    <div class="col-md-5 col-md-offset-4 pull-right">
      <input type="button" class="btn btn-flat btn-default btn-show-order" value="Show Detail Transaction">
      <?=$buttProcess?>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12"><hr/></div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="col-xs-10 col-xs-offset-1">
        <h3>Document History:</h3>
        <ol>
          <?php foreach ($logs as $log) { ?>
            <?php
              echo "<li>".$this->notifier->invoice_log($log->dlog_action, $log->dlog_user_id, $this->convnumber->indonesian_date(strtotime($log->dlog_time), 'd F Y H:i:s', ''))
                    ."<br/>";
              if($log->dlog_action == 'rej'){
                if($log->dlog_note != "")
                  echo "Note: ".$log->dlog_note;
              }
              echo "</li>";
            ?>
          <?php } ?>
        </ol>
        <br/><br/>
        <h4>[DISCLAIMER]</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12"><hr/></div>
    </div>
  </div>

  <div class="row tableTrxReport">
    <div class="col-xs-12">
      <div class="col-xs-10 col-xs-offset-1">
        List of Transaction: <br/>
        <table class='table table-bordered table-stripped'>
          <thead>
            <th class='text-center'>No.</th>
            <th class='text-center'>Order ID</th>
            <th class='text-center'>Book Name</th>
            <th class='text-center'>Amount</th>
          </thead>
          <tbody>
            <?php 
            $subtotal = 0;
            foreach ($orders as $key_o => $order) { 
              if(isset($order[0])){
            ?>
              <tr>
                <td class="text-center"><?=$key_o+1?></td>
                <td class="text-center"><?=$order[0]->qtrx_oid?></td>
                <td><?=$order[0]->qtrx_book_name?></td>
                <td class="text-right"><?=number_format($order[0]->qtrx_price, 0, ',' ,'.')?></td>
              </tr>  
            <?php 
                $subtotal += $order[0]->qtrx_price;
                }
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3" class="text-center">Subtotal</th>
              <th class="text-right"><?=number_format($subtotal, 0, ',' ,'.')?></th>
            </tr>
            <tr>
              <th colspan="3" class="text-center">Share Telkom, <?=$partner->pks_telkom_share."%"?></th>
              <th class="text-right"><?="(".number_format($telkom_share, 0, ',' ,'.').")"?></th>
            </tr>
            <?php
              if($invoice->partner_tax_stat){
                $ppn = ($total/1.1)*(10/100);
                $subtotalB = $subtotal-$telkom_share;
            ?>
            <tr>
              <th colspan="3" class="text-center">Total Sebelum Pajak</th>
              <th class="text-right"><?=number_format($subtotalB, 0, ',' ,'.')?></th>
            </tr>  
            <tr>
              <th colspan="3" class="text-center">10% PPn</th>
              <th class="text-right"><?=number_format($ppn, 0, ',' ,'.')?></th>
            </tr>  
            <?php } ?>
            <tr>
              <th colspan="3" class="text-center">Grand Total</th>
              <th class="text-right"><?=number_format($total, 0, ',' ,'.')?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <form method="POST" enctype="multipart/form-data" action="<?=base_url().$url[1].'/invoices/'.$url_act?>">
        <div class="modal-body">
          <div class="form-group">
              <label class="control-label">Upload Faktur Pajak</label>
              <input id="inputFP" name="inputFP" type="file" class="file-loading">
              <small>*max size 10Mb</small>
            </div>
          <input type="hidden" name="inputInvoice" value="<?=$url[4]?>">
        </div>
        <div class="modal-footer">
          <div class="input-group-btn">
            <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">No</button>
            <button class="btn btn-flat btn-primary" data-toggle="modal">
              <i class="fa fa-check"></i> Yes
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bs-modal-upload" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form method="POST" action="<?=base_url().$url[1].'/invoices/'.$url_act?>">
        <div class="modal-body">
          <p>Dengan ini saya <?=$act?> Invoice ini ?</p>
          <input type="hidden" name="inputInvoice" value="<?=$url[4]?>">
        </div>
        <div class="modal-footer">
          <div class="input-group-btn">
            <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">No</button>
            <button class="btn btn-flat btn-primary" data-toggle="modal">
              <i class="fa fa-check"></i> Yes
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bs-modal-reject" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form method="POST" action="<?=base_url().$url[1].'/invoices/reject'?>">
        <div class="modal-body">
          <p>Apa alasan Anda menolak invoice ini?</p>
          <textarea name="inpNote" required class="form-control"></textarea>
          <input type="hidden" name="inputInvoice" value="<?=$url[4]?>">
        </div>
        <div class="modal-footer">
          <div class="input-group-btn">
            <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cancel</button>
            <button class="btn btn-flat btn-primary" data-toggle="modal">
              <i class="fa fa-check"></i> Proses
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>