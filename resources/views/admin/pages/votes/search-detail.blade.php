<h2>{{ $product->name }}</h2>
<table class="table table-bordered" style="background: #e1e6e9">
    <tr>
        <th>Actual Price</th>
        <th>Existing Discount</th>
        <th>Deal Discount</th>
        <th>Existing Fixed Price</th>
        <th>Deal Fixed Price</th>
    </tr>
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <tr>
        <td class="product-add">
            <input type="number" value="{{ $product->actual_price }}" id="actual_price" readonly
                placeholder="Actual Price" class="form-control form-control-sm product-create">
        </td>
        <td>
            <input type="number" readonly value="{{ $product->discount }}" placeholder="Discount(%)"
                class="form-control form-control-sm">

        </td>
        <td>
            <input type="number" name="deal_discount" id="deal_discount" placeholder="Deal Discount(%)"
                class="form-control form-control-sm discount">
        </td>
        <td>
            <input type="number" value="{{ $product->fixed_price }}" placeholder="Fixed Price"
                class="form-control form-control-sm">

        </td>
        <td>
            <input type="number" placeholder="Deal Fixed Price" name="deal_fixed_price" id="deal_fixed_price"
                class="form-control form-control-sm">

        </td>
    </tr>
</table>
