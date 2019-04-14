<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            var config = {
                headers: {
                    'Accept' : 'application/json',
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX"
                }
            };
            var bodyParameters = {
               key: "value"
            }
            console.log('Component mounted.');
            axios.get('https://stapog.vendhq.com/api/2.0/products', { headers : {
                'Access-Control-Allow-Origin': 'https://stapog.vendhq.com/api/2.0/products',
                'Accept' : 'application/json',
                'Authorization': "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX"
            }}
            ).then(response => {
                console.log(response.data); 
                
            }).catch(error => {
                console.log(error);
            });
        },

    }
</script>
