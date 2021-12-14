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
    driver.find_element(By.ID,"072021").click()
    log('modification du visiteur et du mois reussie')
except Exception as ex:
    log('echec de la modification du visiteur et du mois')
    print(ex)

#tests de la modification des frais
try:
    driver.find_element(By.NAME,"visiteur").click()
    driver.find_element(By.ID,"a131").click()
    driver.find_element(By.NAME,"lstMois").click()
    driver.find_element(By.ID,"122021").click()
    setValeurInput('input[name="ETP"]', 2000)
    setValeurInput('input[name="KM"]', 2000)
    setValeurInput('input[name="NUI"]', 2000)
    setValeurInput('input[name="REP"]', 2000)
    driver.find_element(By.ID,"BtnReset").click()
except Exception as ex:
    print(ex)