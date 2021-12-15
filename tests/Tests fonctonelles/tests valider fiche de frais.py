from tests_connexion_comptable import*
#ouverture de la page permetant de valider les fiches de frais
try:
    driver.find_element(By.NAME,"VficheFrais").click()
    log('Connexion à la page valider les fiches de frais reussie')
except Exception as ex:
    log("erreur de l'ouverture de la page valider les fiches de frais")
    print(ex)
#tests du changement de visiteur et de mois
try:
    driver.find_element(By.NAME,"visiteur").click()
    driver.find_element(By.ID,"f4").click()
    driver.find_element(By.NAME,"lstMois").click()
    driver.find_element(By.ID,"202109").click()
    log('modification du visiteur et du mois reussie')
except Exception as ex:
    log('echec de la modification du visiteur et du mois')
    print(ex)

#tests de la modification des frais
try:
    driver.find_element(By.NAME,"visiteur").click()
    driver.find_element(By.ID,"a131").click()
    driver.find_element(By.NAME,"lstMois").click()
    driver.find_element(By.ID,"202109").click()
    setValeurInput('input[name="ETP"]', 2000)
    setValeurInput('input[name="KM"]', 2000)
    setValeurInput('input[name="NUI"]', 2000)
    setValeurInput('input[name="REP"]', 2000)
    sleep(5)
    driver.find_element(By.ID,"BtnReset").click()
    log('reussite du tests de la modification')
except Exception as ex:
    log('echec de la modification des frais forfaitaires')
    print(ex)

#tests de modification de frais hors forfait
try:
    driver.find_element(By.NAME,"lstMois").click()
    driver.find_element(By.ID,"202109").click()
    setValeurInput('input[name="montant40"]', 200)
    driver.find_element(By.NAME,"btnCorrigerFrais").click()
    sleep(5)
    setValeurInput('input[name="montant40"]', 269.00)
    driver.find_element(By.NAME,"btnCorrigerFrais").click()
    sleep(5)
    driver.find_element(By.NAME,"btnRefuserFrais").click()
    driver.find_element.click()
    log('tests de modification des frais hors forfait réussie')
except Exception as ex:
    log('modification des frais hors forfait échouer')
