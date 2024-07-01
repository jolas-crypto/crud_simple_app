import axios from "axios";

export default {

    async save(method, url, payload) {
        let returnResponse = {
            status: 200,
            success: true,
            data: {}
        }

        try {
            const response = await axios({
                method, url, data: payload
            })

            returnResponse.data = response.data
            returnResponse.success

            return returnResponse

        } catch (error) {
            returnResponse.success = false
            returnResponse.status = error.response
            returnResponse.data = error.response.data.errors

            return returnResponse
        }
    },

    async update(url, payload) {
        let returnResponse = {
            status: 200,
            success: true,
            data: {}
        }

        try {
            const response = await axios.put(url, payload)
            returnResponse.data = response.data
            returnResponse.success

            return returnResponse
        } catch (error) {
            returnResponse.success = false
            returnResponse.status = error.response
            returnResponse.data = error.response.data.errors

            return returnResponse
        }
    },

    async delete(method, url) {
        let returnResponse = {
            status: 200,
            success: true,
            data: {}
        }

        try {
            const response = await axios({
                method, url
            })
            returnResponse.data = response.data
            returnResponse.success

            return returnResponse
        } catch (error) {
            returnResponse.success = false
            returnResponse.status = error.response
            returnResponse.data = error.response.data.errors

            return returnResponse
        }
    },

}