'use strict'

class ZafkielSnackbarStream
{
    newStream(data)
    {
        return this.#streamObject(data);
    }

    #streamObject(data)
    {
        return {
            node : data['node'],
            color: data['color'],
            msg  : data['msg'],
            ttl  : data['ttl'],
            ended: false
        };
    }
}