<html>
  <head>
  </head>
  <body onload="submitPayuForm()" hidden>
    <h2>PayU Form</h2>
    <br/>
    <form action="https://sandboxsecure.payu.in/_payment"
          method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $data['key'] ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $data['txnid'] ?>" />
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?= $data['amount'] ?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?= $data['firstname'] ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?= $data['email'] ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?= $data['phone'] ?>" /></td>
        </tr>
        <tr>
          <td>Product Info: </td>
          <td colspan="3">
              <textarea name="productinfo"><?= $data['productinfo'] ?></textarea></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?= $data['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?= $data['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>
          
            <td colspan="4"><input type="submit" value="Submit" /></td>
         
        </tr>
      </table>
    </form>
    <script type="text/javascript">
        function submitPayuForm(){

          var payuForm = document.forms.payuForm;
          payuForm.submit();
        }
    </script>
  </body>
</html>
