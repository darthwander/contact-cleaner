describe('Should be able to login', () => {
    it('not pass, because the credentials are wrong', () => {
        cy.login('admin', 'teste@wrong.com.br', 'password');
        cy.url().should('include', `/admin/login`)
        cy.get('.mt-2').should('be.visible').and('contain', 'As credenciais fornecidas estão incorretas.')
    })
    it('not pass, because type invalid text inputs', () => {
        cy.login('admin', 'wrong.com.br', 'password');
        cy.url().should('include', `/admin/login`)
        //todo: capture tooltip and verify its content
        //cy.should('be.visible').and('contain', 'Inclua um "@" no endereço de email.')
        //cy.get('#tooltip-target').should('be.visible')
    })

    it('passes', () => {
        cy.login('admin', 'admin@evence.com.br', '123mudar');
        cy.url().should('include', `/admin/dashboard`)
        cy.get('#toast-container').should('be.visible').contains('Você está logado!')
    })

    it('Should deny access to reseller route.', () => {
        cy.visit('http://127.0.0.1:8000/reseller/dashboard')
        cy.url().should('eq', 'http://127.0.0.1:8000/reseller/login')
    })

    it('Should redirect to login why try access to unauthorizated routes.', () => {
        cy.visit('http://127.0.0.1:8000/admin/dashboard')
        cy.url().should('eq', 'http://127.0.0.1:8000/admin/login')
    })

    it('Should deny access to user route', () => {
        cy.visit('http://127.0.0.1:8000/user/dashboard')
        cy.url().should('eq', 'http://127.0.0.1:8000/user/login')
    })

    it('Should redirect to login why try access to unauthorizated routes.', () => {
        cy.visit('http://127.0.0.1:8000/reseller/dashboard')
        cy.url().should('eq', 'http://127.0.0.1:8000/reseller/login')
    })
})

