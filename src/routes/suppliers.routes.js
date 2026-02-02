import { Router } from 'express';
import { body, param, validationResult } from 'express-validator';
import * as controller from '../controllers/suppliers.controller.js';

const router = Router();

const validate = (rules) => [
  ...rules,
  (req, res, next) => {
    const result = validationResult(req);

    if (!result.isEmpty()) {
      return res.status(422).json({ errors: result.array() });
    }

    next();
  }
];

const createRules = [
  body('name')
    .isString()
    .notEmpty()
    .trim()
    .withMessage('El nombre es obligatorio'),

  body('email')
    .isEmail()
    .normalizeEmail()
    .withMessage('Email inválido'),

  body('cif')
    .isString()
    .notEmpty()
    .trim()
    .withMessage('El CIF es obligatorio')
];

const updateRules = [
  param('id')
    .isMongoId()
    .withMessage('ID inválido'),

  body('name')
    .optional()
    .isString()
    .notEmpty()
    .trim(),

  body('email')
    .optional()
    .isEmail()
    .normalizeEmail(),

  body('cif')
    .optional()
    .isString()
    .notEmpty()
    .trim()
];


/**
 * @openapi
 * tags:
 *   - name: Suppliers
 *     description: Gestión de proveedores (Suppliers)
 */

/**
 * @openapi
 * components:
 *   schemas:
 *     Supplier:
 *       type: object
 *       properties:
 *         id:
 *           type: string
 *           example: "64f3c..."
 *         name:
 *           type: string
 *           example: "Electrónica SL"
 *         email:
 *           type: string
 *           example: "contacto@electronica.com"
 *         cif:
 *           type: string
 *           example: "B12345678"
 *         createdAt:
 *           type: string
 *         updatedAt:
 *           type: string
 *     SupplierInput:
 *       type: object
 *       required:
 *         - name
 *         - email
 *         - cif
 *       properties:
 *         name:
 *           type: string
 *           example: "Electrónica SL"
 *         email:
 *           type: string
 *           example: "contacto@electronica.com"
 *         cif:
 *           type: string
 *           example: "B12345678"
 */

/**
 * @openapi
 * /api/v1/suppliers:
 *   get:
 *     summary: Listar todos los proveedores
 *     tags: [Suppliers]
 *     responses:
 *       200:
 *         description: Lista obtenida correctamente
 *         content:
 *           application/json:
 *             schema:
 *               type: array
 *               items:
 *                 $ref: '#/components/schemas/Supplier'
 *   post:
 *     summary: Crear un nuevo proveedor
 *     tags: [Suppliers]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             $ref: '#/components/schemas/SupplierInput'
 *     responses:
 *       201:
 *         description: Proveedor creado
 *       409:
 *         description: Conflicto (Email, Nombre o CIF duplicado)
 *       422:
 *         description: Error de validación
 */
router.get('/', controller.list);
router.post('/', validate(createRules), controller.create);

/**
 * @openapi
 * /api/v1/suppliers/{id}:
 *   get:
 *     summary: Obtener proveedor por ID
 *     tags: [Suppliers]
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: Detalle del proveedor
 *         content:
 *           application/json:
 *             schema:
 *               $ref: '#/components/schemas/Supplier'
 *       404:
 *         description: Proveedor no encontrado
 *   put:
 *     summary: Actualizar proveedor
 *     tags: [Suppliers]
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             $ref: '#/components/schemas/SupplierInput'
 *     responses:
 *       200:
 *         description: Proveedor actualizado
 *       404:
 *         description: Proveedor no encontrado
 *       409:
 *         description: Datos duplicados
 *   delete:
 *     summary: Eliminar proveedor
 *     tags: [Suppliers]
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       204:
 *         description: Eliminado correctamente (sin contenido)
 *       404:
 *         description: Proveedor no encontrado
 */
router.get('/:id', controller.getById);
router.put('/:id', validate(updateRules), controller.update);
router.delete('/:id', controller.remove);

export default router;