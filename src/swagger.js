import swaggerJSDoc from 'swagger-jsdoc';

const options = {
  definition: {
    openapi: '3.0.0',
    info: {
      title: 'API Inventari',
      version: '1.0.0',
      description: 'API para gestión de inventario y proveedores'
    }
  },
  apis: [
    './src/routes/**/*.js'
  ]
};

export const swaggerSpec = swaggerJSDoc(options);