const editProd = (productName, productPrice, typeId, product_id) =>{
    productNameValue = document.getElementById("productName");
    productPriceValue = document.getElementById("productPrice");
    productTypeValue = document.getElementById("productType");
    productIdValue = document.getElementById("productId");
  
    productNameValue.value = productName;
    productPriceValue.value = productPrice;
    productTypeValue.value = typeId;
    productIdValue.value = product_id;  
  };

const editTyp = (typeName, typeDesc, typeId) =>{
    typeNameValue = document.getElementById("typeName");
    typeDescValue = document.getElementById("typeDesc");
    typeIdValue = document.getElementById("typeId");

    typeNameValue.value = typeName
    typeDescValue.value = typeDesc
    typeIdValue.value = typeId
}

const editAcc = (accName, accPassword, accType, accId) =>{
    accNameValue = document.getElementById("accountName");
    accPasswordValue = document.getElementById("accountPassword");
    accTypeValue = document.getElementById("accountType");
    accIdValue = document.getElementById("accountId");

    accNameValue.value = accName;
    accPasswordValue.value = accPassword;
    accTypeValue.value = accType;
    accIdValue.value = accId;
};