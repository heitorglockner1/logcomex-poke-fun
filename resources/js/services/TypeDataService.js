import http from "../http-common";

class TypeDataService {
    getAll() {
        return http.get("/types").then((res) => res.data);
    }
}

export default new TypeDataService();
