<script>
export default {
    props: ['total', 'subs'],
    data(){
        return {
            localTotal: this.total,
            localSubs: this.subs,
            dateDu: '',
            dateAu: ''
        }
    },
    computed: {
        montantTotal(){
            var total = 0;
            this.localSubs.forEach( element => {
                if(element.produit){
                    total += element.produit.price
                }
                
            });
            return total;
        }
    },
    watch : {
        dateDu(){
            if(this.dateAu === ''){
                this.localSubs = this.subs.filter( each => {
                    return ( Date.parse(this.dateDu) < Date.parse(each.created_at)  )
                })
            } else {
                this.localSubs = this.subs.filter( each => {
                    return ( Date.parse(this.dateDu) < Date.parse(each.created_at) &&  Date.parse(this.dateAu) > Date.parse(each.created_at) )
                })
            }
        },
        dateAu(){
            if(this.dateDu === ''){
                this.localSubs = this.subs.filter( each => {
                    return ( Date.parse(this.dateAu) > Date.parse(each.created_at)  )
                })
            } else {
                this.localSubs = this.subs.filter( each => {
                    return ( Date.parse(this.dateDu) < Date.parse(each.created_at) &&  Date.parse(this.dateAu) > Date.parse(each.created_at) )
                })
            }
        },
    },
    methods:{

    },
    mounted(){

    }
}
</script>