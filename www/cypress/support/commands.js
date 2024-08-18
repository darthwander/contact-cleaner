Cypress.Commands.add('login', (entity, email, password) => {
    cy.visit(`http://127.0.0.1:8000/${entity}/login`)
    cy.get('input[name="email"]').type(email)
    cy.get('input[name="password"]').type(password)
    cy.get('button[type="submit"]').click()
  })
