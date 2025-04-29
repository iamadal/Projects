import Fastify from 'fastify';
const app = Fastify();
/* Route MAP */
app.get('/', async (request, response) => {
    return response.status(200).send('Service is Done');
});
app.get('/users/:id', async (request, response) => {
    const { id } = request.params;
    return `This is Userno ${id}`;
});
/* Server */
const start = async () => {
    try {
        await app.listen({ "port": 3000, "host": '0.0.0.0' });
        await app.list;
        console.log('Server listening at http://localhost:3000');
    }
    catch (err) {
        fastify.log.error(err);
        process.exit(1);
    }
};
start();
