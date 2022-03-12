<template>
    <div>
        <h1>Orders</h1>
        <div>
            <div class="row align-items-end mb-3">
                <div class="col-6 col-md-2">
                    <label for="from" class="form-label">Form</label>
                    <input type="date" v-model="from" class="form-control" id="from" aria-describedby="emailHelp">
                </div>
                <div class="col-6 col-md-2">
                    <label for="to" class="form-label">to</label>
                    <input type="date" v-model="to" class="form-control" id="to" aria-describedby="emailHelp">
                </div>
                <div class="col-6 col-md-2">
                    <label for="from" class="form-label">day</label>
                    <select class="form-select"  v-model="day">
                        <option selected>Open this select menu</option>
                        <option value="0">Sunday</option>
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <button class="btn btn-primary"  v-on:click="getOrders">Generate</button>
                </div>
                <div class="col-6 col-md-2" v-if="exporting">
                    <button class="btn btn-success">
                        <export-excel
                            :data   = "products"
                            type    = "csv"
                            :fields = "export_fields">
                            Export
                        </export-excel>
                    </button>
                </div>


            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Times been created</th>
                    <th scope="col">Merchant Name</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td v-text="product.name"></td>
                        <td v-text="product.price +'$' "></td>
                        <td v-text="product.pivot.created_at "></td>
                        <td v-text="product.merchant.merchant_name "></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Orders",
    data() {
        return {
            from : '',
            to : '',
            day : '',
            from_timestamp :'',
            to_timestamp : '',
            exporting : false,
            products : [],
            export_fields: {
                'Product Name': 'name',
                'Product Price	': 'price',
                'Times been created	': 'pivot.created_at',
                'Merchant Name': 'merchant.merchant_name',

            },
        }
    },
    methods :{
        getOrders () {
            axios.get('/api/least-ordered-products-per-day',{
                params: {
                    from: this.from_timestamp,
                    to  : this.to_timestamp,
                    day : this.day
                }
            }).then((response => {
                this.products = response.data.products
                this.exporting = true
            })).catch((error => {
                console.log(error)
            }));
        },
        toTimestamp  (strDate) {
            const dt = Date.parse(strDate);
            return dt / 1000;
        }
    },
    watch: {
        from(newFrom, oldFrom) {
            this.from_timestamp =  this.toTimestamp(newFrom)
        },
        to(newTo, oldTo) {
            this.to_timestamp =this.toTimestamp(newTo)
        }
    },
}
</script>

<style scoped>

</style>
